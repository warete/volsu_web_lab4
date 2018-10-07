<?php

namespace App\Http\Controllers;

use App\Request;
use App\City;
use App\Shop;
use App\Respond;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    /**
     * Возвращает данные для странцы всех заявок на карте
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMapData()
    {
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
                    $arReqResp["id"] = $request->id;
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
    }

    /**
     * Добавляет новый ответ на заявку из формы
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNewRespond(\Illuminate\Http\Request $request)
    {
        $requestData = $request->all();
        $arResponse = array();
        if (!Request::find($requestData['request_id']))
        {
            $arResponse["error"]["text"] = "Неизвестный id заявки.";
            return response()->json($arResponse);
        }
        if (strlen($requestData['message']) == 0)
        {
            $arResponse["error"]["text"] = "Комментарий не может быть пустым!";
            return response()->json($arResponse);
        }
        $newRequest = Respond::create(['status' => 4, 'request_id' => $requestData['request_id'], 'user_id' =>  Auth::user()->id, 'comment' => $requestData['message']]);
        $arResponse["success"] = ["id" => $newRequest->id, "comment" => $newRequest->comment, "text" => "Вы отправили свой ответ на заявку! Ждите одобрения ответа автором заявки."];
        return response()->json($arResponse);
    }
}