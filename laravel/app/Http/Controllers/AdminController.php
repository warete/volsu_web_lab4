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
        $deleteUrlTemplate = '/admin/users/delete/#ID#/';
        $arAdminUrls = [];
        foreach ($arItems as $arItem)
        {
            $arAdminUrls[$arItem['id']]['delete'] = str_replace('#ID#', $arItem['id'], $deleteUrlTemplate);
        }
        return view('admin.list', ['modelName' => 'Пользователи', 'arItems' => $arItems, 'arAdminUrls' => $arAdminUrls]);
    }

    public function citiesList()
    {
        $arItems = City::get()->toArray();
        $deleteUrlTemplate = '/admin/cities/delete/#ID#/';
        $arAdminUrls = [];
        foreach ($arItems as $arItem)
        {
            $arAdminUrls[$arItem['id']]['delete'] = str_replace('#ID#', $arItem['id'], $deleteUrlTemplate);
        }
        return view('admin.list', ['modelName' => 'Города', 'arItems' => $arItems, 'arAdminUrls' => $arAdminUrls]);
    }

    public function shopsList()
    {
        $arItems = Shop::get()->toArray();
        $deleteUrlTemplate = '/admin/shops/delete/#ID#/';
        $arAdminUrls = [];
        foreach ($arItems as $arItem)
        {
            $arAdminUrls[$arItem['id']]['delete'] = str_replace('#ID#', $arItem['id'], $deleteUrlTemplate);
        }
        return view('admin.list', ['modelName' => 'Магазины', 'arItems' => $arItems, 'arAdminUrls' => $arAdminUrls]);
    }

    public function requestsList()
    {
        $arItems = Request::get()->toArray();
        $deleteUrlTemplate = '/admin/requests/delete/#ID#/';
        $arAdminUrls = [];
        foreach ($arItems as $arItem)
        {
            $arAdminUrls[$arItem['id']]['delete'] = str_replace('#ID#', $arItem['id'], $deleteUrlTemplate);
        }
        return view('admin.list', ['modelName' => 'Заявки', 'arItems' => $arItems, 'arAdminUrls' => $arAdminUrls]);
    }

    public function respondsList()
    {
        $arItems = Respond::get()->toArray();
        $deleteUrlTemplate = '/admin/responds/delete/#ID#/';
        $arAdminUrls = [];
        foreach ($arItems as $arItem)
        {
            $arAdminUrls[$arItem['id']]['delete'] = str_replace('#ID#', $arItem['id'], $deleteUrlTemplate);
        }
        return view('admin.list', ['modelName' => 'Ответы на заявки', 'arItems' => $arItems, 'arAdminUrls' => $arAdminUrls]);
    }

    public function respondDeleteItem($id)
    {
        Respond::find($id)->delete();
        return redirect(url()->previous());
    }

    public function userDeleteItem($id)
    {
        User::find($id)->delete();
        return redirect(url()->previous());
    }

    public function cityDeleteItem($id)
    {
        City::find($id)->delete();
        return redirect(url()->previous());
    }

    public function shopDeleteItem($id)
    {
        Shop::find($id)->delete();
        return redirect(url()->previous());
    }

    public function requestDeleteItem($id)
    {
        Request::find($id)->delete();
        return redirect(url()->previous());
    }
}