@if (session('msg.erro'))
    <div class="alert alert-danger justify-content-center d-flex" style="align-items: center;">
        <span><strong class="fs-6">{!! session('msg.erro') !!}</strong></span>
    </div>
@endif
