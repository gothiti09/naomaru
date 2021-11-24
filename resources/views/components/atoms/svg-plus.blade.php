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
<svg class="{{ $class }}" xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 {{ $viewBox }} {{ $viewBox }}" fill="currentColor">
    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
        clip-rule="evenodd" />
</svg>
