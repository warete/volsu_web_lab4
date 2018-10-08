@extends('layouts.inner')

@section('title', 'Панель управления')

@section('content')
    <div class="col-12 row py-2">
        <div class="col-2"><a href="{{ url('/admin/users') }}" class="btn btn-primary btn-block">Пользователи</a></div>
        <div class="col-2"><a href="{{ url('/admin/cities') }}" class="btn btn-primary btn-block">Города</a></div>
        <div class="col-2"><a href="{{ url('/admin/shops') }}" class="btn btn-primary btn-block">Магазины</a></div>
        <div class="col-2"><a href="{{ url('/admin/requests') }}" class="btn btn-primary btn-block">Заявки</a></div>
        <div class="col-4"><a href="{{ url('/admin/responds') }}" class="btn btn-primary btn-block">Ответы на заявки</a></div>
    </div>
@endsection