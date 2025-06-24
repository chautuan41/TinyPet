<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class VnPayController extends Controller
{
    //
    //
    public function createPayment(Request $request)
    {
        $vnp_TmnCode = env('VNPAY_TMN_CODE'); // mã website
        $vnp_HashSecret = env('VNPAY_HASH_SECRET'); // chuỗi bí mật
        $vnp_Url = env('VNPAY_URL'); // url thanh toán
        $vnp_Returnurl = env('VNPAY_RETURN_URL');

        $vnp_TxnRef = 'ORDER' . now()->format('YmdHis') . rand(1000,9999); // Mã giao dịch
        $vnp_OrderInfo = "Thanh toan GD " . $vnp_TxnRef;
        $vnp_OrderType = "other";
        $vnp_Amount = $request->amount; // nhân 100 theo yêu cầu
        $vnp_Locale = $request->language ?? 'vn';
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $request->ip();
        $vnp_ExpireDate = Carbon::now()->addMinutes(15)->format('YmdHis');
        $vnp_CreateDate = Carbon::now()->format('YmdHis');

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate
        ];

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // Không bao gồm vnp_SecureHash khi tạo chuỗi hash
        ksort($inputData);

        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        // Tạo chữ ký
        $vnp_SecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // Thêm vào input
        $inputData['vnp_SecureHash'] = $vnp_SecureHash;

        $paymentUrl = $vnp_Url . '?' . http_build_query($inputData);

        $payment = Payment::create([
            'order_code'     => $vnp_TxnRef,
            'amount'      => $vnp_Amount,
            'status'      => 'pending', // mặc định là chưa thanh toán
        ]);

        return redirect($paymentUrl);
    }
    public function vnpayReturn(Request $request)
    {
        // Lấy secure hash từ URL
        $vnp_SecureHash = $request->get('vnp_SecureHash');

        // Lấy toàn bộ dữ liệu trừ 2 key này
        $inputData = $request->except('vnp_SecureHash', 'vnp_SecureHashType');

        // Sắp xếp theo key alphabet
        ksort($inputData);

        // Tạo chuỗi hash theo đúng chuẩn VNPAY
        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        // Tính toán lại chữ ký
        $secureHash = hash_hmac('sha512', $hashData, env('VNPAY_HASH_SECRET'));

        // Lấy mã giao dịch để tra cứu đơn hàng
        $txnRef = $request->get('vnp_TxnRef');
        $payment = Payment::where('order_code', $txnRef)->first();

        if (!$payment) {
            return response("⛔ Không tìm thấy đơn hàng với mã: $txnRef", 404);
        }

        // So sánh chữ ký
        if ($secureHash === $vnp_SecureHash) {
            // Kiểm tra mã phản hồi từ VNPAY
            if ($request->get('vnp_ResponseCode') === '00') {
                $payment->status = 'success';
            } else {
                $payment->status = 'failed';
            }

            // Lưu thông tin phản hồi từ VNPAY (nếu có)
            $payment->vnp_transaction_no = $request->get('vnp_TransactionNo');
            $payment->vnp_response_code = $request->get('vnp_ResponseCode');
            $payment->save();

            return view('user.pages.resultPayment', ['status' => $payment->status, 'payment' => $payment]);
        } else {
            return response("⚠️ Chữ ký không hợp lệ!", 400);
        }
    }
}
