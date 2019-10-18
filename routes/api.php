<?php

use Illuminate\Http\Request;
use App\Http\Resources\Book as BookResource;
use App\Book;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
    
});

Route::get('buku/{judul}', 'BookController@cetak');

Route::middleware(['cors'])->group(function () {

    Route::get('buku/{judul}', 'BookController@cetak');

});

Route::get('/book', function () {
    return BookResource::collection(Book::all());
});
   
