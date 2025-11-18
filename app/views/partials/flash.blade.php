<div id="flash">
    @php
        $flashTypes = ['success', 'danger', 'warning', 'info'];
    @endphp

    @foreach ($flashTypes as $type)
        @if ($messages = request()->flash($type))
            @foreach ((array) $messages as $message)
                <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif
    @endforeach
</div>
