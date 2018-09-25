<?php

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
    return view('index');
});

//Все заявки
Route::get('requests', function () {
    return view('requests');
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
