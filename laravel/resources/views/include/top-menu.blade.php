<div class="navbar navbar-dark bg-dark box-shadow">
    <div class="container d-flex justify-content-between">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
            <img src="{{{ asset('template/app/img/logo.png') }}}" width="150" height="40" class="d-inline-block align-top" alt="">
        </a>
        <ul class="navbar-nav ml-auto mr-5 d-none d-md-block text-light">
            @if (Auth::check())
                <li class="nav-item mx-2">
                    <strong>{{ Auth::user()->name }}</strong>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ url('logout') }}">Выйти</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="javascript:void(0)" data-toggle="modal" data-target="#AUTH_MODAL" data-dismiss="modal"><strong>Войти</strong></a>
                </li>
            @endif

        </ul>
        <!-- Menu Button -->
        <button class="navbar-toggler menu-btn" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</div>