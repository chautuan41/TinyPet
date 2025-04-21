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

    public function supplierData(Request $request){
       
        $data=DB::table('suppliers')->select(
            '*',
            DB::raw('
                CASE
                    WHEN status = 1 THEN "Đang hoạt động"
                    WHEN status = 2 THEN "Ngưng hoạt động"
                    ELSE 0
                END as statusCustom
            '),
        );
        // if($request->searchInput && $request->searchSelect){
        //     $sInput=$request->searchInput;
        //     $sSelect=$request->searchSelect;

        //     if($sSelect == 'status'){
        //         $data=$data->where($sSelect, $sInput);
        //     }
        //     if($sSelect == 'role_name'){
                
        //         $data=$data->where($sSelect, 'like', '%'.$sInput.'%');
        //     }
        // }
        $data=$data->get();
        
        $totalRecords=count($data);
        
        return response()->json([
            'data' => $data,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords
        ]);
    }

    public function getEditSupplier($id, Request $request){
        $data=DB::table('users')
        ->where('id',  $id)
        ->first();
        
        return response()->json([
            'data' => $data,
            'success' => true
        ]);
        
    }
}
