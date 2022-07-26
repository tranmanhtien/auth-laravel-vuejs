<!-- Alert -->
@if ($messages = session('messages'))
    <div class="alert alert-dismissible alert-success mt-4" role="alert">
        @if (is_array($messages))
            @foreach ($messages as $message)
                {!! $message !!}<br/>
            @endforeach
        @else
            {!! $messages !!}<br/>
        @endif
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
