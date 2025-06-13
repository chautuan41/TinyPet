<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(){
        $dtProduct = db::table('products')
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->select('products.*', 'product_details.price')
        ->where('products.status',1)
        ->limit(6)->get();

        $dtNewProduct = DB::table('products')
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->select('products.*', 'product_details.price')
        ->where('products.status',1)
        ->orderBy('products.updated_at', 'desc')
        ->limit(6)
        ->get();
        
        return view('user.pages.home',compact('dtNewProduct','dtProduct'));
    }

    public function search(){
        return view('user.pages.search');
    }
    public function getSearch(Request $request){
        $request->validate([
            'query' => 'required|max:255|regex:/^[a-zA-Z0-9]+$/',
        ]);

        $data=db::table('products')
        ->where('product_name', 'like', '%'.$request->input('query').'%')
        ->limit(5)
        ->get();

        return response()->json($data);
    }
    public function postSearch(Request $request){

        return view('user.pages.search');
    }

    public function detailProduct($id, Request $request){
        if ($request->inputSearch ) {
            $data=db::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*','product_details.size', 'product_details.price','brands.brand_name')
            ->where('products.id',$id)
            ->first();

             return response()->json([
            'data' => $data,
            
            ]);
        }

        $data=db::table('products')
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->select('products.*','product_details.size', 'product_details.price','brands.brand_name')
        ->where('products.id',$id)
        ->first();

        $sizes=db::table('product_details')
        ->where('product_id',$id)
        ->get();

        return view('user.pages.detailProduct',compact('data','sizes'));


    }

    function addCart(Request $request){

    }
    
}
