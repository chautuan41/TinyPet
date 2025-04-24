<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function product(){
        $dataC=DB::table('categories')->get();
        $dataPT=DB::table('product_types')->get();
        $dataB=DB::table('brands')->get();
        return view('backend.pages.products.product',compact('dataC','dataPT','dataB'));
        
    }

    public function productData(Request $request){
        
        $data=DB::table('products')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('product_types', 'products.product_type_id', '=', 'product_types.id')
        ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
        ->select('*','products.id as id',DB::raw('
            CASE
                WHEN products.status = 1 THEN "Đang hoạt động"
                WHEN products.status = 2 THEN "Ngưng hoạt động"
                ELSE 0
            END as statusCustom
            ')
        );
        if($request->searchInput && $request->searchSelect){
            switch($request->searchSelect){
                case 'status':
                    $data=$data->where('products.status', $request->searchInput);
                    break;
                case 'category':
                    $data=$data->where('products.category_id', $request->searchInput);
                    break;
                case 'brand':
                    $data=$data->where('products.brand_id', $request->searchInput);
                    break;
                case 'product_type':
                    $data=$data->where('products.product_type_id', $request->searchInput);
                    break;
                case 'id':
                    $data=$data->where('products.id', $request->searchInput);
                    break;
                case 'product_name':
                    $data=$data->where('products.product_name','like', '%'.$request->searchInput.'%');
                    break;
                default:
                    break;
                break;
            };
        };
        $data=$data->get();
        $totalRecords=count($data);
        return response()->json([
            'data' => $data,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords
        ]);
    }

    public function getEditProduct($id, Request $request){
        $data=DB::table('products')
        ->leftJoin('categories', 'products.category_id','categories.id' )
        ->where('id',  $id)
        ->first();
        
        $field = [
            [
                'label' => 'Tên sản phẩm',
                'name' => 'product_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => '',
            ],
            [
                'label' => 'Tên sản phẩm',
                'name' => 'product_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => '',
            ],
            [
                'label' => 'Tên sản phẩm',
                'name' => 'product_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => '',
            ],
            [
                'label' => 'Tên sản phẩm',
                'name' => 'product_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => '',
            ],
            [
                'label' => 'Tên sản phẩm',
                'name' => 'product_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => '',
            ],
            [
                'label' => 'Tình trạng',
                'name' => 'status',
                'type' => 'status',
                'placeholder' => 'Nhập status',
                'setting' => '',
            ]
        ];

        $dataFields = array_map(function ($field) use ($data) {
            return [
                'label' => $field['label'],
                'name' => $field['name'],
                'type' => $field['type'],
                'value' => isset($data->{$field['name']}) ? $data->{$field['name']} : "",
                'placeholder' => $field['placeholder'],
                'setting' => $field['setting'],
            ];
        }, $field);

        return response()->json([
            'success' => true,
            'title' => "vai trò",
            'data' => $dataFields,
        ]);
        
    }
}
