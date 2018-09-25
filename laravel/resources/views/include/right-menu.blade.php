<nav class="pushy pushy-right">
    <div class="pushy-content">
        <div class="btn menu-btn text-light float-right"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>
        <div class="d-block d-md-none center-block w-100 text-center py-3">
            <img src="{{{ asset('template/app/img/logo.png') }}}" width="150" height="40" class="d-inline-block align-top" alt="">
        </div>
        <ul class="pt-md-5">
            <li class="pushy-link"><a href="{{ url('/') }}">Главная</a></li>
            <li class="pushy-link"><a href="{{ url('requests') }}">Все заявки</a></li>
            <li class="pushy-link"><a href="{{ url('new-request') }}">Оставить заявку</a></li>
            <li class="pushy-link d-block d-md-none text-uppercase"><a href="{{ url('login') }}"><strong>Войти</strong></a></li>
        </ul>
    </div>
</nav>