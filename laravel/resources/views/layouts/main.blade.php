<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @include('include.meta')

</head>

<body>

<!-- Pushy Menu -->
@include('include.right-menu')

<!-- Site Overlay -->
<div class="site-overlay"></div>
<!-- Content -->
<div id="container">

    @include('include.top-menu')

    <div class="container text-light">
        <div class="row text-center my-3">
            <h1 class="text-shadow">Find Your Socks - Сервис для поиска тайных покупателей носков в Ашане</h1>
        </div>
        <div class="row no-gutters p-5 align-items-center box-shadow instruction bg-content">
            <div class="w-100 text-center text-uppercase">
                <h2>Как найти тайного покупателя?</h2>
            </div>
            <div class="col-1 text-center py-4 instruction__number"><span>1</span></div>
            <div class="col-11 px-4 py-4 instruction__message">Выбери город</div>
            <div class="w-100"></div>
            <div class="col-1 text-center py-4 instruction__number"><span>2</span></div>
            <div class="col-11 px-4 py-4 instruction__message">Выбери подходящий магазин</div>
            <div class="w-100"></div>
            <div class="col-1 text-center py-4 instruction__number"><span>3</span></div>
            <div class="col-11 px-4 py-4 instruction__message">Опиши, какие именно носки тебе нужны</div>
            <div class="w-100"></div>
            <div class="col-1 text-center py-4 instruction__number"><span>4</span></div>
            <div class="col-11 px-4 py-4 instruction__message">Жди отклика соискателей</div>
            <div class="w-100"></div>
            <div class="col-1 text-center py-4 instruction__number"><span>5</span></div>
            <div class="col-11 px-4 py-4 instruction__message">Договорись с соискателем где и как ты получишь носки</div>
            <div class="w-100 mt-3 text-center">
                <a href="#" class="btn btn-lg btn-danger">Оставить заявку</a>
            </div>
        </div>
        <div class="row my-2 p-3 requests">
            <div class="w-100 py-2">
                <h2 class="text-uppercase requests__header">Последние заявки</h2>
            </div>
            @yield('last-requests')
        </div>
    </div>

    @include('include.footer')

</div>

@include('include.scripts')

@include('include.modals')

</body>
</html>
