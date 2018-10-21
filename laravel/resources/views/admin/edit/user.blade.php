@extends('layouts.inner')

@section('title', 'Редактирование - ' . $modelName)

@section('content')
    <div class="col-12 row py-2">
        {{ Form::model($model, array('route' => array('user.edit', $model->id), 'class' => 'col-12')) }}

        <div class="form-group">
            {{ Form::label('name', 'Имя:') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'E-Mail:') }}
            {{ Form::text('email', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}

        {{ Form::close() }}
    </div>
@endsection