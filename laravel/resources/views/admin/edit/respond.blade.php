@extends('layouts.inner')

@section('title', 'Редактирование - ' . $modelName)

@section('content')
    <div class="col-12 row py-2">
        {{ Form::model($model, array('route' => array('respond.edit', $model->id), 'class' => 'col-12')) }}

        <div class="form-group">
            {{ Form::label('status', 'Статус:') }}
            {{ Form::select('status', \App\Respond::getStatuses(), null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('request_id', 'ID заявки:') }}
            {{ Form::text('request_id', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('user_id', 'ID пользователя:') }}
            {{ Form::text('user_id', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}

        {{ Form::close() }}
    </div>
@endsection