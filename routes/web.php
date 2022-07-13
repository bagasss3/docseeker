<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index', [
        'title' => 'Homepage'
    ]);
});
Route::get('/item', function () {
    return view('item', [
        'title' => 'SHOES'
    ]);
});
Route::get('/selected-item', function () {
    return view('selected-item', [
        'title' => 'SELECTED ITEM'
    ]);
});
