<?php
use App\Request;
use App\City;
use App\Shop;

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
Route::get('api/requests/mapdata', function () {
    $jsonResponse = array();

    $cities = City::get();

    $arResp = array();
    foreach ($cities as $city)
    {
        $arResp["cityName"] = $city->name;
        $arResp["shops"] = array();
        $shops = $city->shops;
        $arShopResp = array();
        foreach ($shops as $shop)
        {
            $arShopResp["coordinates"] = array($shop->latitude, $shop->longitude);
            $arShopResp["address"] = $shop->address;
            $arShopResp["requests"] = array();
            $requests = $shop->requests;
            $arReqResp = array();
            foreach($requests as $request)
            {
                $arReqResp["name"] = $request->name;
                $arReqResp["description"] = $request->description;
                $arShopResp["requests"][] = $arReqResp;
                $arReqResp = array();
            }
            if (count($arShopResp["requests"]) > 0)
            {
                $arResp["shops"][] = $arShopResp;
            }
            $arShopResp = array();
        }
        if (count($arResp["shops"]) > 0)
        {
            $jsonResponse[] = $arResp;
        }
        $arResp = array();
    }

    return response()->json($jsonResponse);
});

//Новая заявка
Route::get('new-request', function () {
    return view('new-request');
});

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
