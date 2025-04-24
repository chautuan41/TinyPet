<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class AccountController extends Controller
{
    //
    public function account()
    {
        $dataRoles = DB::table('roles')->get();
        return view('backend.pages.accounts.account',compact('dataRoles'));
    }

    public function data(Request $request)
    {
        
        $data = DB::table('users')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select('*','users.id as idA','users.created_at as created_at','users.updated_at as updated_at',DB::raw('
                CASE
                    WHEN users.status = 1 THEN "Đang hoạt động"
                    WHEN users.status = 2 THEN "Ngưng hoạt động"
                    ELSE "Đã bị khóa"
                END as statusCustom
                ')
            );
            if($request->searchInput && $request->searchSelect){
                switch($request->searchSelect){
                    case 'status':
                        $data=$data->where('users.status', $request->searchInput);
                        break;
                    case 'role_id':
                        $data=$data->where('role_id', $request->searchInput);
                        break;
                    case 'email':
                        $data=$data->where('email', $request->searchInput);
                        break;
                    default:
                    break;
                };
            };
        $data = $data->where('users.role_id' , '!=', 1)->get();

        $totalRecords = count($data);
        
       
        return response()->json([
            'data' => $data,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords
        ]);
    }

    public function showEdit($id)
    {
        $data = DB::table('users')
            ->where('users.id',  $id)
            ->first();

        $fields = [
            [
                'label' => 'Email',
                'name' => 'email',
                'type' => 'text',
                'placeholder' => 'Nhập tên tài khoản',
                'disabled' => 'disabled',
                'select' => '',
            ],
            [
                'label' => 'Tên tài khoản',
                'name' => 'name',
                'type' => 'text',
                'placeholder' => 'Nhập tên tài khoản',
                'disabled' => 'disabled',
                'select' => '',
            ],
            [
                'label' => 'Vai trò',
                'name' => 'role_id',
                'type' => 'text',
                'placeholder' => 'Nhập tên vai trò',
                'disabled' => '',
                'select' => 'select',
            ],
            [
                'label' => 'Trạng thái',
                'name' => 'status',
                'type' => 'status',
                'placeholder' => 'Nhập status',
                'disabled' => '',
                'select' => 'select',
            ]
        ];

        $dataFields = array_map(function ($field) use ($data) {
            return [
                'label' => $field['label'],
                'name' => $field['name'],
                'type' => $field['type'],
                'value' => $data->{$field['name']} ? $data->{$field['name']} : "",
                'placeholder' => $field['placeholder'],
                'disabled' => $field['disabled'],
                'select' => $field['select'],
            ];
        }, $fields);
        
        return response()->json([
            'success' => true,
            'title' => 'tài khoản',
            'data' => $dataFields,
        ]);
    }

    public function postEdit($id, Request $request){

        $request->validate([
            'role_id' => 'required|string|max:255|not_in:1',
            'status' => 'required|in:1,2,3', // Giả sử chỉ có 1 = hoạt động, 2 = ngưng hoạt động, 3 = đã bị khóa
            // thêm các trường khác nếu có
        ]);
        
        try {
            // Cập nhật dữ liệu
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'role_id' => $request->input('role_id'),
                    'status' => $request->input('status'),
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
                
            return response()->json([
                'success' => true,
                'url' => route('admin.account'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật tài khoản: ' . $e->getMessage()
            ]);
        }

    }

    public function view($id)
    {
        $data = DB::table('users')
            ->where('users.id',  $id)
            ->first();

        $fields = [
            [
                'label' => 'Email',
                'name' => 'email',
                'type' => 'text',
                'placeholder' => 'Chưa có tên tài khoản',
                'disabled' => 'disabled',
                'select' => '',
            ],
            [
                'label' => 'Vai trò',
                'name' => 'role_id',
                'type' => 'text',
                'placeholder' => 'Chưa có tên vai trò',
                'disabled' => 'disabled',
                'select' => 'select',
            ],
            [
                'label' => 'Tên tài khoản',
                'name' => 'name',
                'type' => 'text',
                'placeholder' => 'Chưa có tên tài khoản',
                'disabled' => 'disabled',
                'select' => '',
            ],
            [
                'label' => 'Địa chỉ',
                'name' => 'address',
                'type' => 'text',
                'placeholder' => 'Chưa có địa chỉ',
                'disabled' => 'disabled',
                'select' => '',
            ],
            [
                'label' => 'Số điện thoại',
                'name' => 'phone',
                'type' => 'text',
                'placeholder' => 'Chưa có số điện thoại',
                'disabled' => 'disabled',
                'select' => '',
            ],
            [
                'label' => 'Trạng thái',
                'name' => 'status',
                'type' => 'status',
                'placeholder' => 'Chưa có status',
                'disabled' => 'disabled',
                'select' => 'select',
            ]
        ];

        $dataFields = array_map(function ($field) use ($data) {
            return [
                'label' => $field['label'],
                'name' => $field['name'],
                'type' => $field['type'],
                'value' => $data->{$field['name']} ? $data->{$field['name']} : "",
                'placeholder' => $field['placeholder'],
                'disabled' => $field['disabled'],
                'select' => $field['select'],
            ];
        }, $fields);
        
        return response()->json([
            'success' => true,
            'title' => 'tài khoản',
            'data' => $dataFields,
        ]);
    }

    public function delete($id){
        try {
            // Cập nhật dữ liệu
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'status' => 3,
                    'updated_at' => now() // Cập nhật thời gian sửa
                ]);
            return response()->json([
                'success' => true,
                'url' => route('admin.account'), // Redirect sau khi cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mess' => 'Lỗi khi cập nhật vai trò: ' . $e->getMessage()
            ]);
        }
    }
}
