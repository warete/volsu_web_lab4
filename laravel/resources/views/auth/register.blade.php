<form class="form-horizontal" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <input type="hidden" name="modal-type" value="register">

    <div class="form-group">
        <label class="form-label required">Логин</label>
        <input type="text" class="form-control" name="name" placeholder="Введите логин" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group">
        <label class="form-label required">Пароль</label>
        <input type="password" class="form-control" name="password" placeholder="Пароль" required>
        <small class="form-text text-muted">Пароль должен быть не менее 6 символов длиной.</small>

        @if ($errors->has('password'))
            <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group">
        <label class="form-label required">Подтверждение пароля</label>
        <input type="password" class="form-control" name="password_confirmation" placeholder="Подтверждение пароля" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-secondary btn-block">Регистрация</button>
    </div>
    <div class="form-group">
        <p>Если вы уже регистрировались на сайте, то авторизуйтесь.</p>
    </div>
    <div class="form-group">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#AUTH_MODAL" data-dismiss="modal" class="btn btn-outline-secondary btn-block">Войти</a>
    </div>
</form>
@if ($errors->count() > 0 && old('modal-type') == 'register')
    <script>
        $('#REGISTER_MODAL').modal('show');
    </script>
@endif