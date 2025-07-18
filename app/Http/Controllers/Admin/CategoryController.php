<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
      public function index()
    {
        $dataSelect = DB::table('categories')->get();   
        return view('backend.pages.categories.index',compact('dataSelect'));
    }

    public function data(Request $request)
    {
        
        $data = DB::table('categories')
        ->select('*','status as statusCustom');
        if ($request->searchInput && $request->searchSelect) {
            $sInput = $request->searchInput;
            $sSelect = $request->searchSelect;

            if ($sSelect == 'status') {
                $data = $data->where('status', $sInput);
            }
            if ($sSelect == 'category') {
                $data = $data->where('id', $sInput);
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
        $data = DB::table('categories')
            ->where('id',  $id)
            ->first();

        $field = [
            [
                'label' => 'Tên danh mục',
                'name' => 'category_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên danh mục',
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
            'title' => "danh mục",
            'data' => $dataFields,
        ]);
    }

    public function postEdit($id, Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động
            // thêm các trường khác nếu có
        ]);
        try {
            // Cập nhật dữ liệu
            DB::table('categories')
                ->where('id', $id)
                ->update([
                    'category_name' => $request->input('category_name'),
                    'status' => $request->input('status'),
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.category'), // Redirect sau khi cập nhật
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
            'category_name' => 'required|string|max:255',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động
            // thêm các trường khác nếu có
        ]);
        
        try {
            // Thêm dữ liệu
            DB::table('categories')
                ->insert([
                    'category_name' => $request->input('category_name'),
                    'status' => $request->input('status'),
                    'updated_at' => now(), // Cập nhật thời gian sửa
                    'created_at' => now()
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.category'), // Redirect sau khi cập nhật
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
            DB::table('categories')
                ->where('id', $id)
                ->update([
                    'status' => 3,
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.category'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật vai trò: ' . $e->getMessage()
            ]);
        }
    }
}
