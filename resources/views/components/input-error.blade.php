@props(['messages'])

<p {{ $attributes->merge(['class' => 'help is-danger']) }} role="alert">
    @foreach ((array) $messages as $message)
        {{ $message }}
    @endforeach
</p>