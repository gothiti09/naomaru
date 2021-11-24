@props([
    'disabled' => false,
    'color' => 'primary',
    'class' => '',
    'size' => 'base', //xs,sm,base,lg,xl
    'viewBox' => 20,
])
@php
if ($size === 'xs') {
    $class = $class . ' -ml-0.5 mr-2 h-4 w-4';
} elseif ($size === 'sm') {
    $class = $class . ' -ml-0.5 mr-2 h-4 w-4';
} elseif ($size === 'lg') {
    $class = $class . ' -ml-1 mr-2 h-5 w-5';
} elseif ($size === 'xl') {
    $class = $class . ' -ml-1 mr-2 h-5 w-5';
} else {
    $class = $class . ' -ml-1 mr-2 h-5 w-5';
}

@endphp
<svg class="{{ $class }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {{ $viewBox }} {{ $viewBox }}"
    fill="currentColor" aria-hidden="true">
    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
</svg>
