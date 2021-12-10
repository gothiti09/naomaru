@props(['name' => '', 'option' => [], 'checked' => '', 'placeholder' => null, 'disabled' => false])
<div class="flex items-center space-x-3">
    @foreach ($option as $key => $value)
        <div class="flex items-center space-x-1">
            <input id="{{ $name }}{{ $key }}" name="{{ $name }}" value="{{ $key }}"
                {{ $disabled ? 'disabled' : '' }} type="radio"
                class="focus:ring-primary-500 h-4 w-4 text-primary-500 border-gray-300"
                {{ $key == old($name, $checked) || (!$checked && $loop->first) ? 'checked' : '' }}>
            <label for="{{ $name }}{{ $key }}"
                {{ $attributes->merge(['class' => 'ml-3 block text-sm font-medium text-gray-700']) }}>
                {{ $value }}
            </label>
        </div>
    @endforeach
</div>
