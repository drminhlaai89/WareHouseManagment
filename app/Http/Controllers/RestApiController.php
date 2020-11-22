<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestApiController extends Controller
{
    public function getCustomer(){
        $customers=DB::table('customer')->get();
        return $customers;
    }
    public function getProduct(){
        $products=DB::table('product')->get();
        return $products;
    }
    public function getSupplier(){
        $suppliers = DB::table('supplier')->get();
        return $suppliers;
    }
    public function searchSupplier($id){
        $suppliers = DB::table('supplier')->where('id','LIKE',intval($id))->get();
        return $suppliers;
    }
}
