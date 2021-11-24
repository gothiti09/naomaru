@props(['href' => '', 'label' => '', 'icon' => '', 'select' => false, 'class' => 'text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md'])
@php
if ($select) {
    $class = 'bg-gray-900 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md';
}
@endphp

<a href="{{ $href }}" class="{{ $class }}" {{ $attributes }}>
    {{ $slot }}
    {{ $label }}
</a>
