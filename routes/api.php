<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('countries', 'App\Http\Controllers\Api\DataController@getCountries');
    Route::get('products', 'App\Http\Controllers\Api\DataController@getProducts');

    Route::group(['prefix'=> 'collections'], function() {
        Route::get(
            '/',
            'App\Http\Controllers\CollectionController@listCollections'
        );
        Route::get(
            '/{collection_id}',
            'App\Http\Controllers\CollectionController@getCollection'
        );
        Route::get(
            '/{collection_id}/items',
            'App\Http\Controllers\CollectionController@listCollectionItems'
        );
        Route::post(
            '/{collection_id}/items',
            'App\Http\Controllers\CollectionController@createCollectionItem'
        );
        Route::get(
            '/{collection_id}/items/{item_id}',
            'App\Http\Controllers\CollectionController@getCollectionItem'
        );
        Route::put(
            '/{collection_id}/items/{item_id}',
            'App\Http\Controllers\CollectionController@updateCollectionItem'
        );
        Route::patch(
            '/{collection_id}/items/{item_id}',
            'App\Http\Controllers\CollectionController@patchCollectionItem'
        );
        Route::delete(
            '/{collection_id}/items/{item_id}',
            'App\Http\Controllers\CollectionController@removeCollectionItem'
        );
    });
});
