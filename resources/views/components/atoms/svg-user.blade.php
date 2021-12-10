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
    fill="currentColor">
    <path fill-rule="evenodd" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
        clip-rule="evenodd" />
</svg>
