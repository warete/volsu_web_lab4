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
Route::get('/', function () {
    $requestsInfo = Request::where('status', '=', 1)->take(5)->get();
    $arRequests = array();
    foreach ($requestsInfo as $requestItem)
    {
        $arRequests[$requestItem->id] = $requestItem->toArray();
        $arRequests[$requestItem->id]['shop'] = $requestItem->shop->toArray();
        $arRequests[$requestItem->id]['city'] = $requestItem->shop->city->toArray();
    }
    return view('index', ['arRequests' => $arRequests]);
});

//Все заявки
Route::get('requests', function () {
    return view('requests');
});

//Все заявки
Route::get('api/requests/mapdata', 'ApiController@getMapData');

//Новая заявка
Route::get('new-request', function () {
    return view('new-request');
});

Route::post('new-request', array('before' => 'csrf', 'uses' => 'ApiController@addNewRespond'));

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
