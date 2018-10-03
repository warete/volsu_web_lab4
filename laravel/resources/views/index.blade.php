@extends('layouts.main')

@section('title', 'Главная')

@section('last-requests')
    @foreach ($arRequests as $requestItem)
        <div class="card bg-dark w-100 my-2 requests__item bg-content">
            <div class="card-header">
                <h5>{{ $requestItem['name'] }}<span class="float-right">Город: <strong>{{ $requestItem['city']['name'] }}</strong></span></h5>
            </div>
            <div class="card-body row">
                <div class="col-9">
                    <p><strong>Описание: </strong>{{ $requestItem['description'] }}</p>
                    <p><strong>Магазин: </strong>{{ $requestItem['shop']['address'] }}</p>
                </div>
                <div class="col-3 align-self-end">
                    <a href="#" class="btn btn-outline-primary float-right">Ответить на заявку</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection