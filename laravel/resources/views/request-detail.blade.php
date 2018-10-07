@extends('layouts.inner')

@section('title', 'Заявка #' . $arRequest['id'])

@section('content')
    <div class="row p-3 request-detail">
        <div class="col-12 @if (count($arNearbyShops) > 0) col-md-8 @else col-md-12 @endif mb-3 detail-info" @if (count($arNearbyShops) == 0) style="border: none;" @endif>
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
        @if (count($arNearbyShops) > 0)
            <div class="col-12 col-md-4 mb-3">
                <div class="w-100 shops-small-list">
                    <h5 class="shops-small-list__title">Магазины с заявками рядом</h5>
                    @foreach ($arNearbyShops as $nearbyShop)
                        <div class="shops-small-list__item"><a href="#">{{ $nearbyShop['address'] }}</a></div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="col-12 request-detail__map mb-3">
            <div id="map"></div>
        </div>
        <div class="col-12 request-reply">
            <div class="text-center px-5 py-3">
                <a href="#replyForm" class="btn btn-outline-primary btn-block" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="replyForm">Ответить на заявку</a>
            </div>
            <div class="request-reply__form collapse" id="replyForm">
                {{ Form::open(array('url' => 'new-request', 'id' => 'new-request-form')) }}
                    {{ Form::hidden('request_id', $arRequest['id']) }}
                    <div class="form-group">
                        {{ Form::label('message', 'Введите комментарий к ответу. Напишите, почему именно Вас должны выбрать.', array('class' => 'label-form')) }}
                        {{ Form::textarea('message', null, array('cols' => '30', 'rows' => '10', 'class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::button('Отправить', array('class' => 'btn btn-primary btn-lg float-right', 'type' => 'send')) }}
                    </div>
                {{ Form::close() }}
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection

@section('additional-scripts')
    <script>
        var mapData = {!! $arRequest['jsData'] !!};
        detailRequestMap(mapData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            $('#new-request-form').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/new-request',
                    dataType: 'json',
                    data: $('#new-request-form').serialize(),
                    success: function(result){
                        $('#replyForm').find('.alert').remove();
                        if (!result.error)
                        {
                            $('#new-request-form,[href="#replyForm"]').fadeOut(500);
                            $('#replyForm').append('<div class="alert alert-success" role="alert">' + result.success.text + '</div>');
                        }
                        else
                        {
                            $('#replyForm').append('<div class="alert alert-danger" role="alert">' + result.error.text + '</div>');
                        }
                    }
                });
            });
        });
    </script>
@endsection
