<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //
    public function role()
    {
        $dataSelect = DB::table('roles')->get();   
        return view('backend.pages.roles.role',compact('dataSelect'));
    }

    public function data(Request $request)
    {
        
        $data = DB::table('roles')->select(
            '*',
            DB::raw('
                CASE
                    WHEN status = 1 THEN "Đang hoạt động"
                    WHEN status = 2 THEN "Ngưng hoạt động"
                    ELSE 0
                END as statusCustom
            '),
        );

        if ($request->searchInput && $request->searchSelect) {
            $sInput = $request->searchInput;
            $sSelect = $request->searchSelect;

            if ($sSelect == 'status') {
                $data = $data->where($sSelect, $sInput);
            }
            if ($sSelect == 'role_id') {
                
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
        $data = DB::table('roles')
            ->where('id',  $id)
            ->first();

        $field = [
            [
                'label' => 'Tên vai trò',
                'name' => 'role_name',
                'type' => 'text',
                'placeholder' => 'Nhập tên vai trò',
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

    public function postEdit($id, Request $request){
        $request->validate([
            'role_name' => 'required|string|max:255',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động
            // thêm các trường khác nếu có
        ]);
        try {
            // Cập nhật dữ liệu
            DB::table('roles')
                ->where('id', $id)
                ->update([
                    'role_name' => $request->input('role_name'),
                    'status' => $request->input('status'),
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.role'), // Redirect sau khi cập nhật
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
            'role_name' => 'required|string|max:255',
            'status' => 'required|in:1,2', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động
            // thêm các trường khác nếu có
        ]);
        
        try {
            // Thêm dữ liệu
            DB::table('roles')
                ->insert([
                    'role_name' => $request->input('role_name'),
                    'status' => $request->input('status'),
                    'updated_at' => now(), // Cập nhật thời gian sửa
                    'created_at' => now()
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.role'), // Redirect sau khi cập nhật
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
            DB::table('roles')
                ->where('id', $id)
                ->update([
                    'status' => 3,
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
    
            return response()->json([
                'success' => true,
                'url' => route('admin.role'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật vai trò: ' . $e->getMessage()
            ]);
        }
    }
}
