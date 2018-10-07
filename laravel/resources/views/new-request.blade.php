@extends('layouts.inner')

@section('title', 'Новая заявка')

@section('content')
    @if (!Auth::Check())
        <div class="alert alert-danger" role="alert">Доступ запрещен! Для продолжения требуется авторизация.</div>
    @else
        <div class="w-100 p-3 new-request accordion" id="newRequestForm">
        <form class="row p-3">
            <div class="card new-request__item request-item col-12 mb-2 text-light bg-transparent" data-step-id="#newRequestStep1">
                <div class="card-header request-item__header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#newRequestStep1" aria-expanded="true" aria-controls="newRequestStep1">
                            1. Выберите город
                        </button>
                        <span class="float-right done-icon">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </span>
                        <span class="float-right error-icon">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </span>
                    </h5>
                </div>

                <div id="newRequestStep1" class="collapse show" aria-labelledby="headingOne" data-parent="#newRequestForm">
                    <div class="card-body pb-2">
                        <div class="form-group col-12 col-md-6">
                            <select class="form-control" id="city" name="city">
                                <option>Волгоград</option>
                                <option>Москва</option>
                            </select>
                        </div>
                        <div class="float-right">
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#newRequestStep2" aria-expanded="false" aria-controls="newRequestStep2" class="btn btn-secondary" data-action="next-step">Далее</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="card new-request__item request-item col-12 mb-2 text-light bg-transparent" data-step-id="#newRequestStep2">
                <div class="card-header request-item__header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#newRequestStep2" aria-expanded="false" aria-controls="newRequestStep2">
                            2. Выберите магазин
                        </button>
                        <span class="float-right done-icon">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </span>
                        <span class="float-right error-icon">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </span>
                    </h5>
                </div>
                <div id="newRequestStep2" class="collapse" aria-labelledby="headingTwo" data-parent="#newRequestForm">
                    <div class="card-body pb-2">
                        <div class="form-group col-12 col-md-6">
                            <select class="form-control" id="shop" name="shop">
                                <option>пр-т Университетский, 107</option>
                                <option>ул. Историческая 109</option>
                            </select>
                        </div>
                        <div class="float-left">
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#newRequestStep1" aria-expanded="false" aria-controls="newRequestStep1" class="btn btn-secondary" data-action="prev-step">Назад</a>
                        </div>
                        <div class="float-right">
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#newRequestStep3" aria-expanded="false" aria-controls="newRequestStep3" class="btn btn-secondary" data-action="next-step">Далее</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="card new-request__item request-item col-12 mb-2 text-light bg-transparent" data-step-id="#newRequestStep3">
                <div class="card-header request-item__header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#newRequestStep3" aria-expanded="false" aria-controls="newRequestStep3">
                            3. Опишите, какие носки Вам нужны
                        </button>
                        <span class="float-right done-icon">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </span>
                        <span class="float-right error-icon">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </span>
                    </h5>
                </div>
                <div id="newRequestStep3" class="collapse" aria-labelledby="headingThree" data-parent="#newRequestForm">
                    <div class="card-body">
                        <div class="form-group">
                            <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="float-left">
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#newRequestStep2" aria-expanded="false" aria-controls="newRequestStep2" class="btn btn-secondary" data-action="prev-step">Назад</a>
                        </div>
                        <div class="float-right">
                            <button type="send" class="btn btn-primary">Отправить</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
@endsection

@section('additional-scripts')
    <script>
        newRequestLoadData('{{{ asset('template/app/data/map.json') }}}');
        @if (!Auth::check())
            $(document).ready(function () {
                $('#AUTH_MODAL').modal('show');
            });
        @endif
    </script>
@endsection
