<?php

use Illuminate\Http\Request;

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

/*
 *  Users API
 */
Route::group([
    'namespace' => 'API'
],function(){
    /*
     *  Create User
     * */
    Route::post('createUser','UserApiController@createUser');
    /*
     *  Update User
     * */
    Route::post('updateUser','UserApiController@updateUser');
    /*
     *  Get User By ID OR EMAIL ADDRESS OR USERNAME
     * */
    Route::post('getUser','UserApiController@getUser');
    /*
     *  Remove User
     * */
    Route::post('removeUser','UserApiController@removeUser');
});

/*
 *  News API
 */
Route::group([
    'namespace' => 'API'
],function(){
    /*
     *  Create News
     * */
    Route::post('createNews','NewsApiController@createNews');
    /*
     *  Update News
     * */
    Route::post('updateNews','NewsApiController@updateNews');
    /*
     *  Get News By ID OR User ID
     * */
    Route::post('getNews','NewsApiController@getNews');
    /*
     *  Remove News
     * */
    Route::post('removeNews','NewsApiController@removeNews');
});
