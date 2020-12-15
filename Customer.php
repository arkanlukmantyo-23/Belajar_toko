<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    public $timestamps = false;
    
    protected $fillable = ['id_pembeli', 'nama_pembeli', 'alamat_pembeli', 'no_telp','id_barang'];
}
