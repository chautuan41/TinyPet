<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTypeController extends Controller
{
    //
     //
    public function index()
    {
        $dataSelect = DB::table('categories')->get();   
        return view('backend.pages.producttypes.index',compact('dataSelect'));
    }

    public function data(Request $request)
    {
        
        $data = DB::table('product_types')
        ->leftJoin('categories', 'product_types.category_id', '=', 'categories.id')
        ->select('*','product_types.id as idPT','product_types.status as statusCustom','product_types.created_at as created_at','product_types.updated_at as updated_at');
        if ($request->searchInput && $request->searchSelect) {
            $sInput = $request->searchInput;
            $sSelect = $request->searchSelect;

            if ($sSelect == 'status') {
                $data = $data->where('product_types.status', $sInput);
            }
            if ($sSelect == 'product_type_name') {
                
                $data = $data->where('product_type_name','like', '%'.$sInput.'%');
            }
             if ($sSelect == 'category') {
                $data = $data->where('category_id','like', $sInput);
            }
        }
        $data = $data->get();
        $totalRecords = count($data);

        return response()->json([
            'data' => $data,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords
        ]);
    }

    public function showEdit($id)
    {
        $data = DB::table('product_types')
            ->where('id',  $id)
            ->first();

        $field = [
            [
                'label' => 'Tên loại sản phẩm',
                'name' => 'product_type_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên loại sản phẩm',
                'setting' => '',
            ],
            [
                'label' => 'Danh mục',
                'name' => 'category_id',
                'type' => 'text',
                'placeholder' => 'Nhập tên loại sản phẩm',
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
            'title' => "loại sản phẩm",
            'data' => $dataFields,
        ]);
    }

    public function postEdit($id, Request $request){
        $request->validate([
            'product_type_name' => 'required|string|max:255',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động
            // thêm các trường khác nếu có
        ]);
        try {
            // Cập nhật dữ liệu
            DB::table('product_types')
                ->where('id', $id)
                ->update([
                    'product_type_name' => $request->input('product_type_name'),
                    'category_id' => $request->input('category_id'),
                    'status' => $request->input('status'),
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.productType'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật vai trò: ' . $e->getMessage()
            ]);
        }
    }

    public function add(Request $request){

        $request->validate([
            'product_type_name' => 'required|string|max:255',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động
            // thêm các trường khác nếu có
        ]);
        
        try {
            // Thêm dữ liệu
            DB::table('product_types')
                ->insert([
                    'product_type_name' => $request->input('product_type_name'),
                    'category_id' => $request->input('category_id'),
                    'status' => $request->input('status'),
                    'updated_at' => now(), // Cập nhật thời gian sửa
                    'created_at' => now()
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.productType'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật vai trò: ' . $e->getMessage()
            ]);
        }
    }

    public function delete($id){
        try {
            // Cập nhật dữ liệu
            DB::table('product_types')
                ->where('id', $id)
                ->update([
                    'status' => 3,
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.productType'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật vai trò: ' . $e->getMessage()
            ]);
        }
    }
}
