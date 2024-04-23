@if (session('msg.sucesso'))
    <div class="alert alert-success justify-content-center d-flex" style="align-items: center;">
        <span><strong class="fs-6">{!! session('msg.sucesso') !!}</strong></span>
    </div>
@endif
