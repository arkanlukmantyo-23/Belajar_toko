<?php

use Illuminate\Http\Request;
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::group(['middleware' => ['api.superadmin']], function()
    {
        Route::delete('/barang/{id_barang}', 'BarangController@destroy');
        Route::delete('/customer/{id_pembeli}', 'CustomerController@destroy');
        Route::delete('/transaksi/{id_transaksi}', 'TransaksiController@destroy');

    });
    Route::group(['middleware' => ['api.admin']], function()
    {
        Route::post('/barang', 'BarangController@store');
        Route::put('/barang/{id_barang}', 'BarangController@update');

        Route::post('/customer', 'CustomerController@store');
        Route::put('/customer/{id_pembeli}', 'CustomerController@update');

        Route::post('/transaksi', 'TransaksiController@store');
        Route::put('/transaksi/{id_transaksi}', 'TransaksiController@update');

    });


Route::get('/barang', 'BarangController@show');

Route::get('/customer', 'CustomerController@show');
Route::get('/customer/{id_pembeli}', 'CustomerController@detail');

Route::get('/transaksi', 'TransaksiController@show');
Route::get('/transaksi/{id_transaksi}', 'TransaksiController@detail');


});