@extends('layouts.inner')

@section('title', 'Редактирование - ' . $modelName)

@section('content')
    <div class="col-12 row py-2">
        {{ Form::model($model, array('route' => array('shop.edit', $model->id), 'class' => 'col-12')) }}

        <div class="form-group">
            {{ Form::label('address', 'Адрес:') }}
            {{ Form::text('address', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('latitude', 'Широта:') }}
            {{ Form::text('latitude', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('longitude', 'Долгота:') }}
            {{ Form::text('longitude', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('city_id', 'ID города:') }}
            {{ Form::text('city_id', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}

        {{ Form::close() }}
    </div>
@endsection