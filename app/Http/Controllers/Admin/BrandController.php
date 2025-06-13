<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index()
    {
        $dataSelect = DB::table('brands')->get();   
        return view('backend.pages.brands.index',compact('dataSelect'));
    }

    public function data(Request $request)
    {
        
        $data = DB::table('brands')
        ->select('*','.status as statusCustom');
        if ($request->searchInput && $request->searchSelect) {
            $sInput = $request->searchInput;
            $sSelect = $request->searchSelect;
            if ($sSelect == 'status') {
                $data = $data->where('status', $sInput);
            };
            if ($sSelect == 'brand_name') {
                $data = $data->where('brand_name','like', '%'.$sInput.'%');
            };
            
        };
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
        $data = DB::table('brands')
            ->where('id',  $id)
            ->first();

        $field = [
            [
                'label' => 'Tên thương hiệu',
                'name' => 'brand_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên thương hiệu',
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
            'title' => "thương hiệu",
            'data' => $dataFields,
        ]);
    }

    public function postEdit($id, Request $request){
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động
            // thêm các trường khác nếu có
        ]);
        try {
            // Cập nhật dữ liệu
            DB::table('brands')
                ->where('id', $id)
                ->update([
                    'brand_name' => $request->input('brand_name'),
                    'status' => $request->input('status'),
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.brand'), // Redirect sau khi cập nhật
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
            'brand_name' => 'required|string|max:255',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động
            // thêm các trường khác nếu có
        ]);
        
        try {
            // Thêm dữ liệu
            DB::table('brands')
                ->insert([
                    'brand_name' => $request->input('brand_name'),
                    'status' => $request->input('status'),
                    'updated_at' => now(), // Cập nhật thời gian sửa
                    'created_at' => now()
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.brand'), // Redirect sau khi cập nhật
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
            DB::table('brands')
                ->where('id', $id)
                ->update([
                    'status' => 3,
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.brand'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật vai trò: ' . $e->getMessage()
            ]);
        }
    }
}
