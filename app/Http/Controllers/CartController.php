<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\ProductDetail;

class CartController extends Controller
{
    //
    function addCart(Request $request)
    {
        $validated = $request->validate([
            'id_product' => 'required|exists:products,id',
            'id_productDetail' => 'required|exists:product_details,id',
            'quantity' => 'required|integer|min:1'
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
            $cart = session()->get('cart', []);

            if (isset($cart[$idP + $idPD])) {
                $cart[$idP + $idPD]['quantity'] = $cart[$idP + $idPD]['quantity'] + (int)$validated['quantity'];
            } else {
                $cart[$idP + $idPD] = [
                    "name" => $p->product_name,
                    "size" => $pd->size,
                    "quantity" => (int)$validated['quantity'],
                    "price" => $pd->price,
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
            $data = session()->get('cart', []);
        }

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
        } else {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
            }

            return response()->json([
                'message' => 'Đã cập nhật vào giỏ hàng',
            ]);
        };
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
