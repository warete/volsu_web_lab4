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
        $reqStatus = $arRequest["status"];
        $arRequest["status"] = Request::$statuses[$arRequest["status"]];
        $arRequest["status"]["id"] = $reqStatus;
        $arRequest["responds_count"] = Respond::where('request_id', '=', $arRequest['id'])->get()->count();
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
        $hasUserRespond = false;
        $isCreator = false;
        $arResponds = array();
        if (Auth::check())
        {
            if (Auth::user()->id == $request->user->id)
            {
                $responds = $request->responds;
                $arStatuses = array();
                foreach (Respond::$statuses as $key => $status)
                    $arStatuses[$key] = $status["name"];
                $hasAcceptedRespond = false;
                foreach ($responds as $key => $respond)
                {
                    $arResponds[$key] = $respond->toArray();

                    if (in_array($arRequest["status"]["id"], [1, 2]) && !$hasAcceptedRespond && in_array($respond["status"], [1, 2]))
                    {
                        $arResponds[$key]["show_as_select"] = true;
                        $hasAcceptedRespond = true;
                    }
                    else if(in_array($arRequest["status"]["id"], [1]))
                    {
                        $arResponds[$key]["show_as_select"] = true;
                    }
                    else
                    {
                        $arResponds[$key]["show_as_select"] = false;
                    }
                    if(in_array($arRequest["status"]["id"], [3]))
                    {
                        $arResponds[$key]["show_as_select"] = false;
                    }
                    $arResponds[$key]["user"] = $respond->user->toArray();
                    $arResponds[$key]["statuses"] = $arStatuses;
                }
                $isCreator = true;
            }
            else
            {
                $userResponds = Respond::where('user_id', '=', Auth::user()->id)->where('request_id', '=', $arRequest['id'])->first();
                if ($userResponds)
                {
                    $hasUserRespond = true;
                    $arRequest["current_respond_status"] = Respond::$statuses[$userResponds->status];
                    if ($userResponds->status == 1 || $userResponds->status == 2)
                        $arRequest["creator_email"] = $userResponds->request->user->email;
                    else
                        $arRequest["creator_email"] = null;
                }
            }
        }
        return view('request-detail', ['arRequest' => $arRequest, 'arNearbyShops' => $arNearbyShops, 'hasUserRespond' => $hasUserRespond, 'isCreator' => $isCreator, 'arResponds' => $arResponds]);
    }

    /**
     * Последние заявки
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lastRequests()
    {
        $requestsInfo = Request::where('status', '<>', 3)->take(5)->orderBy('id', 'desc')->get();
        $arRequests = array();
        foreach ($requestsInfo as $requestItem)
        {
            $arRequests[$requestItem->id] = $requestItem->toArray();
            $arRequests[$requestItem->id]['shop'] = $requestItem->shop->toArray();
            $arRequests[$requestItem->id]['city'] = $requestItem->shop->city->toArray();
        }
        return view('index', ['arRequests' => $arRequests]);
    }
}