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



Route::get('buku/{judul}', 'BookController@cetak');

Route::middleware(['cors'])->group(function () {

    Route::get('buku/{judul}', 'BookController@cetak');

});

Route::get('/book', function () {
    return BookResource::collection(Book::all());
});

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();

});


Route::prefix('v1')->group(function () {
    // ...
    Route::post('login', [ 'as' => 'login', 'uses' => 'AuthController@login']);
    
    // tambahkan sekalian untuk register dan logout :
    Route::post('register', 'AuthController@register');
    
    Route::get('categories/random/{count}', 'CategoryController@random');
    Route::get('categories', 'CategoryController@index');

    Route::get('books/top/{count}', 'BookController@top');
    Route::get('books', 'BookController@index');


    //private route
    Route::middleware('auth:api')->group(function () {

        Route::post('logout', 'AuthController@logout');

    });

   

});
   
   
