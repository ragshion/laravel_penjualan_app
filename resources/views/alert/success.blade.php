@if(session('status'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"><i class="fal fa-times-circle"></i></span>
    </button>
    <strong>Berhasil!</strong> {{ session('status') }}
</div>
@endif
