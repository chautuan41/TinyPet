<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\ProductDetail;

use function Laravel\Prompts\table;

class HomeController extends Controller
{
    //
    public function index()
    {
        // QUERY BUILDER
        //    $dtProduct1 = DB::table('products')
        //     ->select('products.*')
        //     ->addSelect([
        //         'price' => DB::table('product_details')
        //             ->select('price')
        //             ->whereColumn('product_id', 'products.id')
        //             ->orderBy('price', 'asc')
        //             ->limit(1)
        //     ])
        //     ->where('products.status', 1)
        //     ->limit(6)
        //     ->get();

        //ELOQUENT
        $dtProduct = Product::withMin('productDetails', 'price')
            ->addSelect([
                'image' => DB::table('images')
                    ->select('image_path')
                    ->whereColumn('product_id', 'products.id')
                    ->limit(1)
            ])
            ->where('status', 1)
            ->limit(6)
            ->get();


        // $dtNewProduct = DB::table('products')
        // ->join('product_details', 'products.id', '=', 'product_details.product_id')
        // ->select('products.*', 'product_details.price')
        // ->where('products.status',1)
        // ->orderBy('products.updated_at', 'desc')
        // ->limit(6)
        // ->get();

        $dtNewProduct = Product::withMin('productDetails', 'price')
            ->addSelect([
                'image' => DB::table('images')
                    ->select('image_path')
                    ->whereColumn('product_id', 'products.id')
                    ->limit(1)
            ])
            ->where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->limit(6)
            ->get();

        return view('user.pages.home', compact('dtNewProduct', 'dtProduct'));
    }

    public function search()
    {
        return view('user.pages.search');
    }
    public function getSearch(Request $request)
    {
        $request->validate([
            'query' => 'required|max:255|regex:/^[a-zA-Z0-9]+$/',
        ]);

        $data = db::table('products')
            ->where('product_name', 'like', '%' . $request->input('query') . '%')
            ->limit(5)
            ->get();

        return response()->json($data);
    }
    public function postSearch(Request $request)
    {
        $request->validate([
            'keyword' => 'required|max:255|regex:/^[a-zA-Z0-9]+$/',
        ]);

        $keyword = $request->query('keyword');

        $data = Product::withMin('productDetails', 'price')
            ->where('product_name', 'like', '%' . $keyword . '%')
            ->get();

        return view('user.pages.product', compact('data', 'keyword'));
    }

    public function detailProduct($id)
    {

        $images = Image::where('product_id', $id)->get();

        $data = db::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'product_details.id as id_productDetail', 'product_details.quantity', 'product_details.size', 'product_details.price', 'brands.brand_name')
            ->where('products.id', $id)
            ->first();

        $sizes = db::table('product_details')
            ->where('product_id', $id)
            ->get();

        return view('user.pages.detailProduct', compact('data', 'sizes', 'images'));
    }



    public function product()
    {
        $data = $dtProduct = Product::withMin('productDetails', 'price')
            ->where('status', 1)
            ->get();

        $keyword = "";

        return view('user.pages.product', compact('data', 'keyword'));
    }

    

    function checkout()
    {
        if (auth()->check()) {
            $carts = cart::with('productDetail', 'product')
                ->where('user_id', auth()->id())
                ->get();
        } else {
            $carts = session()->get('cart');

            for($i=0;$i<=10;$i++){
                for($j=0;$j<=10;$j++){
                    $product =ProductDetail::where('product_id', $i)
                    ->select('price')
                    ->first();
                    
                    if ($product) {
                    $cart[$i + $j]["price"] = $product->price;
                    };
                    }
                }
            }
            
            session()->put('cart', $cart);
        
        return view('user.pages.checkout', compact('carts'));
    }
}
