@extends('layouts.inner')

@section('title', 'Панель управления - ' . $modelName)

@section('content')
    <div class="col-12 row py-2">
        @if (count($arItems) > 0)
            <table class="table">
                <thead>
                    <tr>
                        @foreach ($arItems[0] as $key => $arItem)
                            <th scope="col">{{ $key }}</th>
                        @endforeach
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($arItems as $key => $arItem)
                    <tr>
                        @foreach ($arItem as $arField)
                            <td>{{ $arField }}</td>
                        @endforeach
                        <td>
                            <a href="#"><i class="fa fa-pencil-alt text-light" aria-hidden="true"></i></a>
                            <a href="{{ $arAdminUrls[$arItem['id']]['delete'] }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection