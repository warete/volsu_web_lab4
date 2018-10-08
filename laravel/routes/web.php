<?php
use App\Request;
use App\City;
use App\Shop;
use App\Respond;

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

//Главная
Route::get('/', 'RequestController@lastRequests');

//Все заявки
Route::get('requests', function () {
    return view('requests');
});

//Все заявки (api)
Route::get('api/requests/mapdata', 'ApiController@getMapData');

// Смена статуса ответа на заявку (api)
Route::post('api/respond/status', 'ApiController@changeRespondStatus');

//Новая заявка
Route::get('new-request', function () {
    return view('new-request');
});

Route::post('new-respond', array('before' => 'csrf', 'uses' => 'ApiController@addNewRespond'));
Route::post('new-request', array('before' => 'csrf', 'uses' => 'ApiController@addNewRequest'));

//Детальная страница заявки
Route::get('request/{request}', array('uses' => 'RequestController@getDetailInfo'));

/***********************************/
/*     Авторизация/регистрация     */
/***********************************/
//POST запрос аутентификации на сайте
Route::post('login', 'Auth\LoginController@login');
//GET запрос на выход из системы (логаут)
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//POST запрос регистрации на сайте
Route::post('register', 'Auth\RegisterController@register');
Auth::routes();

/***********************************/
/*             Админка             */
/***********************************/
Route::middleware('admin')->prefix('/admin')->group(function () {
    Route::get('/', function (){
        return view('admin.index');
    });
    Route::get('/users', 'AdminController@usersList');
    Route::get('/cities', 'AdminController@citiesList');
    Route::get('/shops', 'AdminController@shopsList');
    Route::get('/requests', 'AdminController@requestsList');
    Route::get('/responds', 'AdminController@respondsList');
});
