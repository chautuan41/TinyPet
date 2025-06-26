<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\ProductDetail;
use Ramsey\Uuid\Type\Integer;

class CartController extends Controller
{
    //
    function addCart(Request $request)
    {
        $validated = $request->validate([
            'id_product' => 'required|exists:products,id',
            'id_productDetail' => 'required|exists:product_details,id',
            'quantity' => ['required', 'numeric', 'gt:0']
        ]);

        if (auth()->check()) {
            $cart = Cart::firstOrNew([
                'user_id' => auth()->id(),
                'product_id' => $validated['id_product'],
                'product_detail_id' => $validated['id_productDetail'],
            ]);
            $cart->quantity += (int) $validated['quantity'];
            $cart->save();
        } else {
            $idP = $validated['id_product'];
            $idPD = $validated['id_productDetail'];
            $p = Product::findOrFail($idP);
            $pd = ProductDetail::findOrFail($idPD);
            $idCart = "{$idP}_{$idPD}";

            $cart = session()->get('cart', []);
            if (isset($cart[$idCart])) {
                if((int)$validated['quantity'] + $cart[$idCart]['quantity'] > $cart[$idCart]['max']){
                    $cart[$idCart]['quantity'] = $cart[$idCart]['max'];
                }else{
                    $cart[$idCart]['quantity'] = $cart[$idCart]['quantity'] + (int)$validated['quantity'];
                }
                
            } else {
                $cart[$idCart] = [
                    "name" => $p->product_name,
                    "size" => $pd->size,
                    "quantity" => (int)$validated['quantity'] > $pd->quantity ? $pd->quantity : (int)$validated['quantity'],
                    "price" => $pd->price,
                    "max" => $pd->quantity,
                ];
            }

            session()->put('cart', $cart);
        };


        return response()->json([
            'message' => 'Đã thêm vào giỏ hàng',
            'cart' => $cart
        ]);
    }

    function cart()
    {
        if (auth()->check()) {
            $data = cart::with('productDetail', 'product')
                ->where('user_id', auth()->id())
                ->get();
        } else {
            $cart = session()->get('cart', []);
            $updatedCart = [];

            foreach ($cart as $key => $item) {
                // Tách key để lấy id_product và id_productDetail
                [$idProduct, $idProductDetail] = explode('_', $key);

                // Tìm ProductDetail hiện tại
                $productDetail = ProductDetail::find($idProductDetail);

                if ($productDetail) {
                    // Cập nhật lại thông tin sản phẩm nếu cần
                    $item['price'] = $productDetail->price;
                   
                }

                $updatedCart[$key] = $item;
            }

            session()->put('cart', $updatedCart);
            $data = $updatedCart;
        };

        return view('user.pages.cart', compact('data'));
    }

    public function clear()
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }

    public function update(Request $request)
{
    $request->validate([
        'quantity' => ['required', 'numeric', 'gt:0']
    ]);

    if (auth()->check()) {
        $cart = Cart::firstOrNew([
            'user_id' => auth()->id(),
            'product_id' => $request->id_product,
            'product_detail_id' => $request->id_productDetail,
        ]);

        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json([
            'message' => 'Đã cập nhật vào giỏ hàng',
        ]);
    }

    // Xử lý cho guest (session)
    $cart = session()->get('cart', []);
    $key = $request->id; // dạng "productId_productDetailId"
    $message = '';
    $max=false;
    if (isset($cart[$key])) {
        [$idProduct, $idProductDetail] = explode('_', $key);

        $productDetail = ProductDetail::find($idProductDetail);

        if ($productDetail) {
            $currentStock = $productDetail->quantity;
            $productPrice = $productDetail->price;

            // Cập nhật lại giá mới nhất
            $cart[$key]['price'] = $productPrice;
            $price[$key] = $productPrice;
            $maxQty[$key] = $currentStock;

            if ($request->quantity > $currentStock) {
                $max=true;
                $cart[$key]['quantity'] = $qty = $currentStock;
                $message = "Số lượng bạn đặt ({$request->quantity}) vượt quá tồn kho ({$currentStock}). Đã tự động điều chỉnh.";
            } else {
                $cart[$key]['quantity'] = $qty = $request->quantity;
                $message = "Đã cập nhật vào giỏ hàng với số lượng: {$qty}";
            }

            // Cập nhật lại session
            session()->put('cart', $cart);
        } else {
            return response()->json([
                'message' => 'Sản phẩm không tồn tại.',
            ], 404);
        }
    } else {
        return response()->json([
            'message' => 'Sản phẩm không có trong giỏ hàng.',
        ], 404);
    }

    return response()->json([
        'message' => $message,
        'quantity' => $qty,
        'max' => $max,
        'price' => $productPrice,
    ]);
}

    public function remove(Request $request)
    {
        
        if (auth()->check()) {
            $cart = Cart::find($request->id)
                ->delete();

            return response()->json([
                'message' => 'Đã cập nhật vào giỏ hàng',
                'cart' => $cart
            ]);
        } else {
            if ($request->id) {
                $cart = session()->get('cart');

                unset($cart[$request->id]);

                session()->put('cart', $cart);

                return response()->json([
                    'message' => 'Đã xóa sản phẩm',
                ]);
            }
            return response()->json([
                'message' => $request->id,
            ]);
        }
    }
}
