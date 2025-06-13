<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    //
    public function supplier(){
        return view('backend.pages.suppliers.supplier');
    }

    public function data(Request $request){
       
        $data=DB::table('suppliers')
        ->select('*','suppliers.status as statusCustom');
        if($request->searchInput && $request->searchSelect){
            $sInput=$request->searchInput;
            $sSelect=$request->searchSelect;

            if($sSelect == 'status'){
                $data=$data->where($sSelect, $sInput);
            }
            if($sSelect == 'supplier_name'){
                
                $data=$data->where($sSelect, 'like', '%'.$sInput.'%');
            }
        }
        $data=$data->get();
        
        $totalRecords=count($data);
        
        return response()->json([
            'data' => $data,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords
        ]);
    }

    public function showEdit($id, Request $request){
        $data=DB::table('suppliers')
        ->where('id',  $id)
        ->first();
        
        $field = [
            [
                'label' => 'Tên nhà cung cấp',
                'name' => 'supplier_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên vai trò',
                'setting' => '',
            ],
            [
                'label' => 'Địa chỉ',
                'name' => 'supplier_address',
                'type' => 'text',
                'placeholder' => 'Nhập địa chỉ',
                'setting' => '',
            ],
            [
                'label' => 'Số điện thoại',
                'name' => 'supplier_phone',
                'type' => 'text',
                'placeholder' => 'Nhập số điện thoại',
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
            'title' => 'nhà cung cấp',
            'data' => $dataFields,
            'success' => true
        ]);
        
    }

    public function postEdit($id, Request $request){
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_address' => 'required|string|max:255',
            'supplier_phone' => 'required|string|regex:/^(0)[0-9]{9}$/',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động
            // thêm các trường khác nếu có
        ]);

        try {
            // Cập nhật dữ liệu
            DB::table('suppliers')
                ->where('id', $id)
                ->update([
                    'supplier_name' => $request->input('supplier_name'),
                    'supplier_address' => $request->input('supplier_address'),
                    'supplier_phone' => $request->input('supplier_phone'),
                    'status' => $request->input('status'),
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.supplier'), // Redirect sau khi cập nhật
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
            'supplier_name' => 'required|string|max:255',
            'supplier_address' => 'required|string|max:255',
            'supplier_phone' => 'required|string|regex:/^(0)[0-9]{9}$/',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động, 3 = đã bị khóa
            // thêm các trường khác nếu có
        ]);
        
        try {
            // Thêm dữ liệu
            DB::table('suppliers')
                ->insert([
                    'supplier_name' => $request->input('supplier_name'),
                    'supplier_address' => $request->input('supplier_address'),
                    'supplier_phone' => $request->input('supplier_phone'),
                    'status' => $request->input('status'),
                    'updated_at' => now(), // Cập nhật thời gian sửa
                    'created_at' => now()
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.supplier'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi thêm sản phẩm: ' . $e->getMessage()
            ]);
        }
    }

    public function delete($id){
        try {
            // Cập nhật dữ liệu
            DB::table('suppliers')
                ->where('id', $id)
                ->update([
                    'status' => 3,
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
            return response()->json([
                'success' => true,
                'url' => route('admin.supplier'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật sản phẩm: ' . $e->getMessage()
            ]);
        }
    }

    
}
