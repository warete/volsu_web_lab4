<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <input type="hidden" name="modal-type" value="login">

    <div class="form-group">
        <label class="form-label">Логин</label>
        <input type="text" class="form-control" name="name" placeholder="Введите логин" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group">
        <label class="form-label">Пароль</label>
        <input type="password" class="form-control" name="password" placeholder="Пароль">

        @if ($errors->has('password'))
            <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-secondary btn-block">Войти</button>
    </div>
    <div class="form-group">
        <p>Если Вы впервые на сайте, заполните, пожалуйста, регистрационную форму.</p>
    </div>
    <div class="form-group">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#REGISTER_MODAL" data-dismiss="modal" class="btn btn-outline-secondary btn-block">Регистрация</a>
    </div>
</form>
@if ($errors->count() > 0 && old('modal-type') == 'login')
    <script>
        $('#AUTH_MODAL').modal('show');
    </script>
@endif