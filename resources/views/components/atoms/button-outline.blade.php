@props([
    'type' => 'button',
    'disabled' => false,
    'round' => true,
    'color' => 'primary',
    'class' => '',
    'size' => 'base', //xs,sm,base,lg,xl
])
@php
if ($size === 'xs') {
    $class = $class . ' px-2.5 py-1.5 text-xs';
} elseif ($size === 'sm') {
    $class = $class . ' px-3 py-2 text-sm leading-4';
} elseif ($size === 'lg') {
    $class = $class . ' px-4 py-2 text-base';
} elseif ($size === 'xl') {
    $class = $class . ' px-6 py-3 text-base';
} else {
    $class = $class . ' px-4 py-2 text-sm';
}
if ($round) {
    $class = $class . ' rounded-full';
} else {
    $class = $class . ' rounded';
}
@endphp
<button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes }}
    class="inline-flex items-center justify-center border border-{{ $color }}-300 shadow-sm font-medium rounded text-{{ $color }}-700 bg-white hover:bg-{{ $color }}-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $color }}-500 {{ $class }}">
    {{ $slot }}
</button>
