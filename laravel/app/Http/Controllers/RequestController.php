<?php

namespace App\Http\Controllers;

use App\Request;
use App\City;
use App\Shop;
use App\Respond;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Возвращает детальную инфомрацию о заявке
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDetailInfo(Request $request)
    {
        $arRequest = $request->toArray();
        $shop = $request->shop;
        $arRequest["shop"] = $shop->toArray();
        $arRequest["city"] = $shop->city->toArray();
        $arRequest["status"] = Request::$statuses[$arRequest["status"]];
        $arRequest["jsData"] = json_encode([
            "coordinates" => [$arRequest["shop"]["latitude"], $arRequest["shop"]["longitude"]],
            "address" => $arRequest["shop"]["address"],
            "name" => $arRequest["name"],
            "description" => $arRequest["description"]
        ]);
        $nearbyShops = Shop::where('city_id', '=', $arRequest["city"]['id'])->where('id', '<>', $arRequest["shop"]['id'])->get();
        $arNearbyShops = array();
        foreach ($nearbyShops as $nearbyShop)
        {
            if ($nearbyShop->requests->count() > 0)
            {
                $arNearbyShops[$nearbyShop->id] = $nearbyShop->toArray();
            }
        }
        return view('request-detail', ['arRequest' => $arRequest, 'arNearbyShops' => $arNearbyShops]);
    }
}