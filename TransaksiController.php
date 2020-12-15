<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function show()
    {
        $data_transaksi=Transaksi::join('customer','customer.id_pembeli','transaksi.id_pembeli')->get();
        return Response()->json($data_transaksi);
    }
    public function detail($id_transaksi)
    {
        if(Transaksi::where('id',$id_transaksi)->exists()){
            $data_transaksi= Transaksi::join('customer','customer.id_pembeli','transaksi.id_pembeli')
                                     ->where('transaksi.id_transaksi','=',$id_transaksi)
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
                'tanggal_transaksi' => 'required',
                'keterangan' => 'required',
                'id_pembeli' => 'required'
            ]
        );
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $simpan = Transaksi::create([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'keterangan' => $request->keterangan,
            'id_pembeli' => $request->id_pembeli,
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
    public function update($id_transaksi, Request $request)
        {
            $validator=Validator::make($request->all(),
                [
                'tanggal_transaksi' => 'required',
                'keterangan' => 'required',
                'id_pembeli' => 'required'
                ]
            );
            if($validator->fails()) {
                return Response()->json($validator->errors());
            }
            $ubah = Transaksi::where('id_pembeli', $id_transaksi)->update([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'keterangan' => $request->keterangan,
                'id_pembeli' => $request->id_pembeli,
            ]);
        
            if($ubah) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
            }
        }
        public function destroy($id_transaksi)
            {
                $hapus = Transaksi::where('id_transaksi', $id_transaksi)->delete();
                if($hapus) {
                    return Response()->json(['status' => 1]);
                }
                else {
                    return Response()->json(['status' => 0]);
            }
        }
}
