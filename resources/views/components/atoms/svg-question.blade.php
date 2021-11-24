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
        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
