@extends('layouts.inner')

@section('title', 'Заявка #' . $arRequest['id'])

@section('content')
    <div class="row p-3 request-detail">
        <div class="col-12 col-md-8 mb-3 detail-info">
            <div class="detail-info__item info-item py-1">
                <strong class="info-item__name text-primary">Название:</strong>
                <span class="info-item__value">{{ $arRequest['name'] }}</span>
            </div>
            <div class="detail-info__item info-item py-1">
                <strong class="info-item__name text-primary">Город:</strong>
                <span class="info-item__value">{{ $arRequest['city']['name'] }}</span>
            </div>
            <div class="detail-info__item info-item py-1">
                <strong class="info-item__name text-primary">Магазин:</strong>
                <span class="info-item__value">{{ $arRequest['shop']['address'] }}</span>
            </div>
            <div class="detail-info__item info-item py-1">
                <strong class="info-item__name text-primary">Описание:</strong>
                <span class="info-item__value">{{ $arRequest['description'] }}</span>
            </div>
            <div class="detail-info__item info-item py-1">
                <strong class="info-item__name text-primary">Количество ответов:</strong>
                <span class="info-item__value">0</span>
            </div>
            <div class="detail-info__item info-item py-1">
                <strong class="info-item__name text-primary">Статус:</strong>
                <span class="info-item__value status status_{{ $arRequest['status']['class'] }}">{{ $arRequest['status']['name'] }}</span>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="w-100 shops-small-list">
                <a class="shops-small-list__title" href="#"><h5>Магазины с заявками рядом</h5></a>
                @foreach ($arNearbyShops as $nearbyShop)
                    <div class="shops-small-list__item"><a href="#">{{ $nearbyShop['address'] }}</a></div>
                @endforeach
            </div>
        </div>
        <div class="col-12 request-detail__map mb-3">
            <div id="map"></div>
        </div>
        <div class="col-12 request-reply">
            <div class="text-center px-5 py-3">
                <a href="#replyForm" class="btn btn-outline-primary btn-block" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="replyForm">Ответить на заявку</a>
            </div>
            <div class="request-reply__form collapse" id="replyForm">
                <form>
                    <div class="form-group">
                        <label class="label-form">Введите комментарий к ответу. Напишите, почему именно Вас должны выбрать.</label>
                        <textarea name="message" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg float-right" type="send">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('additional-scripts')
    <script>
        var mapData = {!! $arRequest['jsData'] !!};
        detailRequestMap(mapData);
    </script>
@endsection
