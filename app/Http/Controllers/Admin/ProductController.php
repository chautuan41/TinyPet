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

    public function data(Request $request){
        
        $data=DB::table('products')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('product_types', 'products.product_type_id', '=', 'product_types.id')
        ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
        ->select('*','products.id as id','products.status as statusCustom');
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
                    $data=$data->where('products.product_name', );
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

    public function showEdit($id, Request $request){
        $data=DB::table('products')
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
                'label' => 'Thông tin sản phẩm',
                'name' => 'description',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => '',
            ],
            [
                'label' => 'Ảnh',
                'name' => 'avatar',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => '',
            ],
            [
                'label' => 'Danh mục',
                'name' => 'category_id',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => 'select',
            ],
            [
                'label' => 'Loại sản phẩm',
                'name' => 'product_type_id',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => 'select',
            ],
            [
                'label' => 'Thương hiệu',
                'name' => 'brand_id',
                'type' => 'text',
                'placeholder' => 'Nhập tên sản phẩm',
                'setting' => 'select',
            ],
            [
                'label' => 'Tình trạng',
                'name' => 'status',
                'type' => 'status',
                'placeholder' => 'Nhập status',
                'setting' => 'select',
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
            'title' => "sản phẩm",
            'data' => $dataFields,
        ]);
        
    }

    public function postEdit($id, Request $request){

        $request->validate([
            'product_name' => 'required|string|max:255|',
            'description' => 'required|string|',
            'avatar' => 'required|string|max:255|',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'product_type_id' => 'required|integer',
            'status' => 'required|in:1,2,3', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động, 3 = đã bị khóa
            // thêm các trường khác nếu có
        ]);
        
        try {
            // Cập nhật dữ liệu
            DB::table('products')
                ->where('id', $id)
                ->update([
                    'product_name' => $request->input('product_name'),
                    'description' => $request->input('description'),
                    'avatar' => $request->input('avatar'),
                    'category_id' => $request->input('category_id'),
                    'product_type_id' => $request->input('product_type_id'),
                    'brand_id' => $request->input('brand_id'),
                    'status' => $request->input('status'),
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
                
            return response()->json([
                'success' => true,
                'url' => route('admin.product'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật sản phẩm: ' . $e->getMessage()
            ]);
        }

    }

    public function add(Request $request){

        $request->validate([
            'product_name' => 'required|string|max:255|',
            'description' => 'required|string|',
            'avatar' => 'required|string|max:255|',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'product_type_id' => 'required|integer',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động, 3 = đã bị khóa
            // thêm các trường khác nếu có
        ]);
        
        try {
            // Thêm dữ liệu
            DB::table('products')
                ->insert([
                    'product_name' => $request->input('product_name'),
                    'description' => $request->input('description'),
                    'avatar' => $request->input('avatar'),
                    'category_id' => $request->input('category_id'),
                    'product_type_id' => $request->input('product_type_id'),
                    'brand_id' => $request->input('brand_id'),
                    'status' => $request->input('status'),
                    'updated_at' => now(), // Cập nhật thời gian sửa
                    'created_at' => now()
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.product'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi thêm sản phẩm: ' . $e->getMessage()
            ]);
        }
    }

    public function view($id){
        $dataID= db::table('products')
        ->where('id',$id)
        ->select('*',DB::raw('
            CASE
                WHEN status = 1 THEN "Đang hoạt động"
                WHEN status = 2 THEN "Tạm ngưng hoạt động"
            END as statusCustom
            ')
        )
        ->get();
        $dataDT = db::table('product_details')
        ->where('product_id',$id)
        ->where('status',1)
        ->select('*',DB::raw('
            CASE
                WHEN status = 1 THEN "Đang hoạt động"
                WHEN status = 2 THEN "Tạm ngưng hoạt động"
            END as statusCustom
            ')
        )
        ->get();

        return response()->json([
            'success' => true,
            'dataDT' => $dataDT,
            'dataID' => $dataID,
        ]);
    }

    public function delete($id){
        try {
            // Cập nhật dữ liệu
            DB::table('products')
                ->where('id', $id)
                ->update([
                    'status' => 3,
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
            return response()->json([
                'success' => true,
                'url' => route('admin.product'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật sản phẩm: ' . $e->getMessage()
            ]);
        }
    }
}
