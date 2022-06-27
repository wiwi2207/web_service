<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    //
    public function index()
    {
        $data = Customers::all();
        return response()-> json ($data, 200);

    }

    public function show(Customers $id){
        return response()->json($id, 200);
    }

    public function show($id){
        $data = Customer::where('id', $id)->first();
        if(empty($data)){
            return response()->json([
                'pesan'=>'data tidak ditemukan',
                'data'=> $data
            ], 404);
        }

        return response()->json([
            'pesan'=>'data ditemukan',
            'data'=> $data
        ], 200);

    }

    public function store (Request $request){
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        if ($validate->fails()){
            return $validate->errors();
        }

        
        $data = Customer::create($request->all());
        return response()->json([
            'pesan' => 'data berhasil disimpan',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id){
        
        $data = Customer::where('id', $id)->first();

        //cek data dengan id yang dikirimikan
        if(empty($data)){
            return response()->json([
                'pesan'=>'data tidak ditemukan',
                'data'=> $data
            ], 404);
        }

        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        if ($validate->fails()){
            return $validate->errors();
        }
        //proses simpan prubahan data
        $data->update($request->all());
        return response()->json([
            'pesan' => 'data berhasil diupdate',
            'data' => $data
        ], 203);
    
    }

    public function delete($id){
        $data = Customer::where('id', $id)->first();

        if(empty($data)){
            return response()->json([
                'pesan'=>'data tidak ditemukan',
                'data'=> $data
            ], 404);
        }

        $data->delete();

        return response()->json([
            'pesan'=>'data berhasil dihapus',
            'data'=> $data
        ], 200);
    }
}