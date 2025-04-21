<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->select('*','users.id as id',DB::raw('
            CASE
                WHEN users.status = 1 THEN "Đang hoạt động"
                WHEN users.status = 2 THEN "Ngưng hoạt động"
                ELSE 0
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
                'label' => 'Vai trò',
                'name' => 'role_id',
                'type' => 'text',
                'placeholder' => 'Nhập tên vai trò',
                'disabled' => '',
                'select' => 'select',
            ],
            [
                'label' => 'Tên tài khoản',
                'name' => 'name',
                'type' => 'text',
                'placeholder' => 'Nhập tên tài khoản',
                'disabled' => '',
                'select' => '',
            ],
            [
                'label' => 'Địa chỉ',
                'name' => 'address',
                'type' => 'text',
                'placeholder' => 'Nhập địa chỉ',
                'disabled' => '',
                'select' => '',
            ],
            [
                'label' => 'Số điện thoại',
                'name' => 'phone',
                'type' => 'text',
                'placeholder' => 'Nhập số điện thoại',
                'disabled' => '',
                'select' => '',
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
}
