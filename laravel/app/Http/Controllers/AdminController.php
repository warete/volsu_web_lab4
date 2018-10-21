<?php

namespace App\Http\Controllers;

use App\Request;
use App\City;
use App\Shop;
use App\Respond;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function usersList()
    {
        $arItems = User::get()->toArray();
        return view('admin.list', ['modelName' => 'Пользователи', 'arItems' => $arItems]);
    }

    public function citiesList()
    {
        $arItems = City::get()->toArray();
        return view('admin.list', ['modelName' => 'Города', 'arItems' => $arItems]);
    }

    public function shopsList()
    {
        $arItems = Shop::get()->toArray();
        return view('admin.list', ['modelName' => 'Магазины', 'arItems' => $arItems]);
    }

    public function requestsList()
    {
        $arItems = Request::get()->toArray();
        return view('admin.list', ['modelName' => 'Заявки', 'arItems' => $arItems]);
    }

    public function respondsList()
    {
        $arItems = Respond::get()->toArray();
        return view('admin.list', ['modelName' => 'Ответы на заявки', 'arItems' => $arItems]);
    }

    public function respondDeleteItem($id)
    {
        Respond::find($id)->delete();
        return redirect(url()->previous());
    }
}