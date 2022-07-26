@if (isset($errors) && $errors = $errors->all())
    <div class="alert alert-dismissible alert-danger mt-4" role="alert">
        @foreach ($errors as $error)
            {!! $error !!}<br/>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
