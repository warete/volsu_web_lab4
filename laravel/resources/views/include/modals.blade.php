<!-- Auth Modal -->
<div class="modal fade" id="AUTH_MODAL" tabindex="-1" role="dialog" aria-labelledby="AUTH_MODAL_Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authModalLabel">Авторизация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('auth.login')
            </div>
        </div>
    </div>
</div>
<!-- Auth Modal -->
<div class="modal fade" id="REGISTER_MODAL" tabindex="-1" role="dialog" aria-labelledby="REGISTER_MODAL_Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('auth.register')
            </div>
        </div>
    </div>
</div>