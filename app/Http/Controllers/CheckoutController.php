<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\product;
use App\Models\ProductDetail;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    //
    function checkout()
    {
        if (auth()->check()) {
            $data = cart::with('productDetail', 'product')
                ->addSelect([
                    'image' => DB::table('images')
                        ->select('image_path')
                        ->whereColumn('product_id', 'carts.product_id')
                        ->limit(1)
                ])
                ->where('user_id', auth()->id())
                ->get();
            $info=User::find(auth()->id());
        } else {

            $data = session()->get('cart', []);

            $info = session()->get('info', []);
        };
        

        return view('user.pages.checkout', compact('data', 'info'));
    }

    public function createPayment(Request $request)
    {

        $vnp_TmnCode = env('VNPAY_TMN_CODE'); // mã website
        $vnp_HashSecret = env('VNPAY_HASH_SECRET'); // chuỗi bí mật
        $vnp_Url = env('VNPAY_URL'); // url thanh toán
        $vnp_Returnurl = env('VNPAY_RETURN_URL');

        $vnp_TxnRef = 'ORDER' . now()->format('YmdHis') . rand(1000, 9999); // Mã giao dịch
        $vnp_OrderInfo = "Thanh toan GD " . $vnp_TxnRef;
        $vnp_OrderType = "other";
        $vnp_Amount = $request->amount * 100; // nhân 100 theo yêu cầu
        $vnp_Locale = $request->language ?? 'vn';
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $request->ip();
        $vnp_ExpireDate = Carbon::now()->addMinutes(15)->format('YmdHis');
        $vnp_CreateDate = Carbon::now()->format('YmdHis');

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
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

        Order::create([
            'order_code'     => $vnp_TxnRef,
            'customer_name'      => $request->name,
            'customer_phone'     => $request->phone,
            'customer_address'      => $request->address,
            'email'     => $request->email,
            'user_id'      => auth()->id() ?? null,
            'amount'      => $vnp_Amount / 100,
            'status'      => 1, // mặc định là chưa thanh toán
        ]);

        $order = Order::where('order_code', $vnp_TxnRef)->first();

        if(auth()->check()){
            $carts=Cart::where('user_id',auth()->id())->get();
        }else{
             $carts = session()->get('cart', []);
        }
           

        foreach ($carts as $id => $cart) {
            if(auth()->check()){
                $idProductDetail = $cart->product_detail_id;
            }else{
                [$idProduct, $idProductDetail] = explode('_', $id);
            }
            
            OrderDetail::create([
                'order_code'     => $vnp_TxnRef,
                'order_id'      => $order->id,
                'product_detail_id'     => $idProductDetail,
                'price'      => $cart['price'],
                'quantity'     => $cart['quantity'],
                'status'      => 1, // mặc định là chưa thanh toán
            ]);
        }

        if ($request->save_info) {
            $info = session()->get('info', []);

            $info = [
                "name" => $request->name,
                "phone" => $request->phone,
                "email" => $request->email,
                "address" => $request->address,
            ];

            session()->put('info', $info);
        }

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
        $order = Order::where('order_code', $txnRef)->first();


        if (!$order) {
            return response("⛔ Không tìm thấy đơn hàng với mã: $txnRef", 404);
        }

        // So sánh chữ ký
        if ($secureHash === $vnp_SecureHash) {
            // Kiểm tra mã phản hồi từ VNPAY
            if ($request->get('vnp_ResponseCode') === '00') {
                $order->status = 2;

                $orderDts = OrderDetail::where('order_id', $order->id)->get();

                foreach ($orderDts as $orderDt) {
                    if ($orderDt->status != 2) {
                        $pd = ProductDetail::find($orderDt->product_detail_id);
                       
                        $qty = $pd->quantity;
                        $newQty = $orderDt->quantity;

                        // Trừ số lượng và cập nhật
                        $pd->quantity = $qty - $newQty;
                        $pd->updated_at=now();
                        $pd->save();

                        // Cập nhật status của order detail
                        $orderDt->status = 2;
                        $orderDt->save();
                    }
                }

                if (auth()->check()) {
                    Cart::where('user_id', auth()->id())->delete();
                } else {
                    session()->forget('cart');
                }
                
            } else {
                $order->status = 3;
            }

            // Lưu thông tin phản hồi từ VNPAY (nếu có)
            $order->vnp_transaction_no = $request->get('vnp_TransactionNo');
            $order->vnp_response_code = $request->get('vnp_ResponseCode');
            $order->save();



            return view('user.pages.resultPayment', ['status' => $order->status, 'payment' => $order]);
        } else {
            return response("⚠️ Chữ ký không hợp lệ!", 400);
        }
    }
}
