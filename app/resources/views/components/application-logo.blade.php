@props(['name' => 'logo-app.svg'])

<img {{ $attributes->class([]) }} src="{{ Vite::asset('resources/images/'.$name) }}" alt="{{ config('app.name') }}">
