<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index()
    {
        $data = Products::all();
        return response()-> json ($data, 200);

    }

    public function show(Products $id){
        return response()->json($id, 200);
    }
}
