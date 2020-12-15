<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function show()
    {
        $data_customer=Customer::join('barang','barang.id_barang','customer.id_barang')->get();
        return Response()->json($data_customer);
    }
    public function detail($id_pembeli)
    {
        if(Customer::where('id_',$id_pembeli)->exists()){
            $data_customer= Customer::join('barang','barang.id_barang','customer.id_barang')
                                     ->where('customer.id_pembeli','=',$id_pembeli)
                                     ->get();
            
            return Response()->json($data_customer);
        }
        else{
            return Response()->json(['message'=>'tidak ditemukan']);
        }
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'nama_pembeli' => 'required',
                'alamat_pembeli' => 'required',
                'no_telp' => 'required',
                'id_barang' => 'required'
            ]
        );
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $simpan = Customer::create([
            'nama_pembeli' => $request->nama_pembeli,
            'alamat_pembeli' => $request->alamat_pembeli,
            'no_telp' => $request->no_telp,
            'id_barang' => $request->id_barang
        ]);
        if($simpan)
        {
            return Response()->json(['status' => 1]);
        }
        else
        {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id_pembeli, Request $request)
        {
            $validator=Validator::make($request->all(),
                [
                    'nama_pembeli' => 'required',
                    'alamat_pembeli' => 'required',
                    'no_telp' => 'required',
                    'id_barang' => 'required'
                ]
            );
            if($validator->fails()) {
                return Response()->json($validator->errors());
            }
            $ubah = Customer::where('id_barang ', $id_pembeli)->update([
                'nama_pembeli' => $request->nama_pembeli,
                'alamat_pembeli' => $request->alamat_pembeli,
                'no_telp' => $request->no_telp,
                'id_barang' => $request->id_barang
            ]);
        
            if($ubah) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
            }
        }
        public function destroy($id_pembeli)
            {
                $hapus = Customer::where('id_pembeli', $id_pembeli)->delete();
                if($hapus) {
                    return Response()->json(['status' => 1]);
                }
                else {
                    return Response()->json(['status' => 0]);
            }
        }
}
