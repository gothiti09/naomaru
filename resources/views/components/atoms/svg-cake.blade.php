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

<svg class="{{ $class }}" xmlns="http://www.w3.org/2000/svg" fill="none"
    viewBox="0 0 {{ $viewBox }} {{ $viewBox }}" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
</svg>
