<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\ProductDetail;
use Ramsey\Uuid\Type\Integer;
use App\Models\Order;
use App\Models\OrderDetail;

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

        try {
            $idP = $validated['id_product'];
            $idPD = $validated['id_productDetail'];
            $p = Product::findOrFail($idP);
            $pd = ProductDetail::findOrFail($idPD);
            $img = Image::findOrFail($idP);
            if (auth()->check()) {
                $cart = Cart::firstOrNew([
                    'user_id' => auth()->id(),
                    'product_id' => $validated['id_product'],
                    'product_detail_id' => $validated['id_productDetail'],
                ]);

                $newQty = (int) $validated['quantity'] + $cart->quantity;
                $cart->quantity = min($newQty, $pd->quantity);
                $cart->price = $pd->price;
                $cart->save();
            } else {
                $cart = session()->get('cart', []);

                $idCart = "{$idP}_{$idPD}";

                if (isset($cart[$idCart])) {
                    $newQty = (int) $validated['quantity'] +  $cart[$idCart]['quantity'];
                    $cart[$idCart]['quantity'] =  min($newQty, $pd->quantity);

                } else {
                    $cart[$idCart] = [
                        "product_id" =>  $validated['id_product'],
                        "name" => $p->product_name,
                        "size" => $pd->size,
                        "quantity" => (int)$validated['quantity'] > $pd->quantity ? $pd->quantity : (int)$validated['quantity'],
                        "price" => $pd->price,
                        "max" => $pd->quantity,
                        "image" => $img->image_path,
                    ];
                }

                session()->put('cart', $cart);
            };


            return response()->json([
                'message' => 'Đã thêm vào giỏ hàng',
                'cart' => $cart
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật tài khoản: ' . $e->getMessage()
            ]);
        }
    }

    function cart()
    {
        if (auth()->check()) {
            $carts = cart::with('productDetail', 'product')
            ->where('user_id', auth()->id())->get();

            // Lấy danh sách product_detail_id để fetch một lần
            $productDetailIds = $carts->pluck('product_detail_id')->unique();
         
             // Fetch toàn bộ ProductDetail cần thiết 1 lần
            $productDetails = ProductDetail::whereIn('id', $productDetailIds)
            ->get()->keyBy('id'); // Key = id, value = quantity
           
            foreach($carts as $cart){
                    $qty=($productDetails[$cart->product_detail_id]->quantity < $cart->quantity)? $productDetails[$cart->product_detail_id]->quantity:$cart->quantity;
                    DB::table('carts')
                    ->where('id', $cart->id)
                    ->update([
                        'price' => $productDetails[$cart->product_detail_id]->price ,
                        'quantity' => $qty ,
                        'updated_at' => now() // Cập nhật thời gian sửa
                    ]);
                
            };

            $data = cart::with('productDetail', 'product')
            ->where('user_id', auth()->id())
            ->get();
           
        } else {
            
            $cart = session()->get('cart', []);
            $updatedCart = [];

            // Lấy danh sách id_productDetail từ session
            $detailIds = collect($cart)->keys()
                ->map(fn($key) => explode('_', $key)[1])
                ->unique()
                ->toArray();

            // Lấy tất cả ProductDetail cần thiết trong 1 truy vấn
            $productDetails = ProductDetail::whereIn('id', $detailIds)
                ->get()
                ->keyBy('id');

            foreach ($cart as $key => $item) {
                [$idProduct, $idProductDetail] = explode('_', $key);

                if (isset($productDetails[$idProductDetail])) {
                    $pd = $productDetails[$idProductDetail];

                    // Cập nhật giá và tồn kho
                    $item['price'] = $pd->price;
                    $item['max'] = $pd->quantity;

                    // Giới hạn số lượng nếu vượt quá tồn kho
                    $item['quantity'] = min($item['quantity'], $pd->quantity);
                }

                $updatedCart[$key] = $item;
            }

            // foreach ($cart as $key => $item) {
            //     // Tách key để lấy id_product và id_productDetail
            //     [$idProduct, $idProductDetail] = explode('_', $key);

            //     // Tìm ProductDetail hiện tại
            //     $productDetail = ProductDetail::find($idProductDetail);

            //     if ($productDetail) {
            //         // Cập nhật lại thông tin sản phẩm nếu cần
            //         $item['price'] = $productDetail->price;
            //         $item['max'] = $productDetail->quantity;

            //          $item['quantity'] = min($item['quantity'], $productDetail->quantity);
            //     }

            //     $updatedCart[$key] = $item;
            // }

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
          
            $productDetails = ProductDetail::find($request->id_productDetail);
           
            $qty = ($productDetails->quantity < $request->quantity) ? $productDetails->quantity :$request->quantity;

            DB::table('carts')
                ->where('id', $request->id)
                ->where('user_id', auth()->id())
                ->update([
                        'quantity' => $qty,
                        'updated_at' => now() // Cập nhật thời gian sửa
                    ]);
            $cart=DB::table('carts')
            ->where('user_id', auth()->id())
            ->get();
            $total = 0;
            foreach($cart as $dt){
                $detail = ProductDetail::find($dt->product_detail_id);
                $total += $dt->quantity * $detail->price;
            }
            return response()->json([
                'message' => 'Đã cập nhật giỏ hàng',
                'quantity' => $qty,
                'max' =>  $productDetails->quantity,
                'price' => $productDetails->price,
                'total' => $total,
            ]);

        };

        // Xử lý cho guest (session)
        $cart = session()->get('cart', []);
        $key = $request->id; // dạng "productId_productDetailId"
        $message = '';
        
        if (isset($cart[$key])) {
            [$idProduct, $idProductDetail] = explode('_', $key);

            $productDetail = ProductDetail::find($idProductDetail);

            if ($productDetail) {
                $currentStock = $productDetail->quantity;
                $productPrice = $productDetail->price;

                // Cập nhật lại giá mới nhất
                $cart[$key]['price'] = $productPrice;
                
                if ( $currentStock < $request->quantity ) {
                    $cart[$key]['quantity'] = $cart[$key]['max'] = $qty = $currentStock;
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

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        return response()->json([
            'message' => $message,
            'quantity' => $qty,
            'max' =>  $currentStock,
            'price' => $productPrice,
            'total' => $total,
        ]);
    }

    public function remove(Request $request)
    {

        if (auth()->check()) {
            $cart = db::table('carts')
                ->where('user_id',auth()->id())
                ->where('id',$request->id)
                ->delete();

        } else {
            $cart = session()->get('cart');

            unset($cart[$request->id]);

            session()->put('cart', $cart);
        }
        return response()->json([
                'message' => 'Đã xóa sản phẩm',
            ]);
    }
}
