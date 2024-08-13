@props(['href' => null, 'disabled' => false, 'append' => null, 'prepend' => null, 'color' => 'primary', 'size' => 'md', 'inverted' => false])

@php
$class = 'inline-flex justify-center items-center space-x-2 rounded text-sm font-semibold transition duration-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-purple disabled:cursor-not-allowed disabled:opacity-75';
switch ($color) {
    case 'primary':
    default:
        $class .= $inverted ? ' bg-color-004aad/90 text-white hover:bg-color-004aad' : ' bg-color-004aad text-white hover:bg-color-004aad/90';
        break;
    case 'secondary':
        $class .= $inverted ? ' bg-color-343a40 text-white hover:bg-color-f4f4f4 hover:text-color-343a40' : ' bg-color-f4f4f4 hover:bg-color-343a40 hover:text-white';
        break;
    case 'light':
        $class .= $inverted ? ' bg-color-f8f8f8 text-6c757d hover:bg-white' : ' text-6c757d hover:bg-color-f8f8f8';
        break;
    case 'dark':
        $class .= $inverted ? ' bg-color-343a40/90 text-white hover:bg-color-343a40' : ' bg-color-343a40 text-white hover:bg-color-343a40/90';
        break;
    case 'action':
         $class .= $inverted ? ' bg-color-ff8f6e/90 text-white hover:bg-color-ff8f6e' : ' bg-color-ff8f6e text-white hover:bg-color-ff8f6e/90';
         break;
     case 'danger':
         $class .= $inverted ? ' bg-white text-red-500 hover:bg-red-500 hover:text-white' : ' bg-red-500 text-white hover:bg-red-500/90';
         break;
}

switch ($size) {
    case 'md':
    default:
        $class .= ' h-10 py-3 px-3.5';
        break;
    case 'xs':
        $class .= ' h-7 py-2.5 px-3';
        break;
    case 'sm':
        $class .= ' h-8 py-2.5 px-3.5';
        break;
    case 'lg':
        $class .= ' h-12 py-3.5 px-4.5';
        break;
}
@endphp

@if($href)
    <a href="{{$href}}" {{ $attributes->merge(['class' => $class]) }}>
        @if($prepend)
            {{ $prepend }}
        @endif
        <span>{{ $slot }}</span>
        @if($append)
            {{ $append }}
        @endif
    </a>
@else
    <button
        {{ $attributes->merge(['type' => 'submit', 'class' => $class]) }}
        @disabled($disabled)
    >
        @if($prepend)
            {{ $prepend }}
        @endif
        <span>{{ $slot }}</span>
        @if($append)
            {{ $append }}
        @endif
    </button>
@endif
