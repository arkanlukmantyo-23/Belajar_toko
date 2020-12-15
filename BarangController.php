<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function show()
    {
        return Barang::all();
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'nama_barang' => 'required',
                'harga' => 'required',
                'stok' => 'required'
            ]
        );
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $simpan = Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok
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
    public function update($id_barang, Request $request)
        {
            $validator=Validator::make($request->all(),
                [
                'nama_barang' => 'required',
                'harga' => 'required',
                'stok' => 'required'
                ]
            );
            if($validator->fails()) {
                return Response()->json($validator->errors());
            }
            $ubah = Barang::where('id_barang', $id_barang)->update([
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
            ]);
        
            if($ubah) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
            }
        }
        public function destroy($id_barang)
            {
                $hapus = Barang::where('id_barang', $id_barang)->delete();
                if($hapus) {
                    return Response()->json(['status' => 1]);
                }
                else {
                    return Response()->json(['status' => 0]);
            }
        }
   
}
