@extends('layouts.main')

@section('title', 'Главная')

@section('last-requests')
    <div class="card bg-dark w-100 my-2 requests__item bg-content">
        <div class="card-header">
            <h5>Синие носки с котятами<span class="float-right">Город: <strong>Волгоград</strong></span></h5>
        </div>
        <div class="card-body row">
            <div class="col-9">
                <p><strong>Описание: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, accusamus adipisci animi doloremque id inventore laborum odio quibusdam repudiandae tempore?</p>
                <p><strong>Магазин: </strong>Пр-т Университетский, 101</p>
            </div>
            <div class="col-3 align-self-end">
                <a href="#" class="btn btn-outline-primary float-right">Ответить на заявку</a>
            </div>
        </div>
    </div>
    <div class="card bg-dark w-100 my-2 requests__item bg-content">
        <div class="card-header">
            <h5>Желтые носки с единорогом<span class="float-right">Город: <strong>Москва</strong></span></h5>
        </div>
        <div class="card-body row">
            <div class="col-9">
                <p><strong>Описание: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, accusamus adipisci animi doloremque id inventore laborum odio quibusdam repudiandae tempore?</p>
                <p><strong>Магазин: </strong>ул. Ленинская Слобода, 26</p>
            </div>
            <div class="col-3 align-self-end">
                <a href="#" class="btn btn-outline-primary float-right">Ответить на заявку</a>
            </div>
        </div>
    </div>
    <div class="card bg-dark w-100 my-2 requests__item bg-content">
        <div class="card-header">
            <h5>Синие носки с котятами<span class="float-right">Город: <strong>Волгоград</strong></span></h5>
        </div>
        <div class="card-body row">
            <div class="col-9">
                <p><strong>Описание: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, accusamus adipisci animi doloremque id inventore laborum odio quibusdam repudiandae tempore?</p>
                <p><strong>Магазин: </strong>Пр-т Университетский, 101</p>
            </div>
            <div class="col-3 align-self-end">
                <a href="#" class="btn btn-outline-primary float-right">Ответить на заявку</a>
            </div>
        </div>
    </div>
@endsection