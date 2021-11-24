@props(['value'])
<label {!! $attributes->merge(['class' => 'text-gray-500 max-w-lg block w-full sm:max-w-xs sm:text-sm']) !!}>
    {{ $value ?? $slot }}
</label>
