<?php
use App\Request;
use App\City;
use App\Shop;
use App\Respond;
use App\User;

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

    Route::get('/responds/delete/{id}', 'AdminController@respondDeleteItem');
    Route::get('/users/delete/{id}', 'AdminController@userDeleteItem');
    Route::get('/cities/delete/{id}', 'AdminController@cityDeleteItem');
    Route::get('/shops/delete/{id}', 'AdminController@shopDeleteItem');
    Route::get('/requests/delete/{id}', 'AdminController@requestDeleteItem');

    Route::get('/users/edit/{id}', array('as' => 'user.edit', function($id)
    {
        return view('admin.edit.user', ['model' => User::find($id), 'modelName' => 'Пользователи']);
    }));
    Route::post('/users/edit/{id}', 'AdminController@userEditItem')->name('user.edit');

    Route::get('/responds/edit/{id}', array('as' => 'respond.edit', function($id)
    {
        return view('admin.edit.respond', ['model' => Respond::find($id), 'modelName' => 'Ответы на заявки']);
    }));
    Route::post('/responds/edit/{id}', 'AdminController@respondEditItem')->name('respond.edit');

    Route::get('/cities/edit/{id}', array('as' => 'city.edit', function($id)
    {
        return view('admin.edit.city', ['model' => City::find($id), 'modelName' => 'Города']);
    }));
    Route::post('/cities/edit/{id}', 'AdminController@cityEditItem')->name('city.edit');

    Route::get('/shops/edit/{id}', array('as' => 'shop.edit', function($id)
    {
        return view('admin.edit.shop', ['model' => Shop::find($id), 'modelName' => 'Магазины']);
    }));
    Route::post('/shops/edit/{id}', 'AdminController@shopEditItem')->name('shop.edit');

    Route::get('/requests/edit/{id}', array('as' => 'request.edit', function($id)
    {
        return view('admin.edit.request', ['model' => Request::find($id), 'modelName' => 'Заявки']);
    }));
    Route::post('/requests/edit/{id}', 'AdminController@requestEditItem')->name('request.edit');
});
