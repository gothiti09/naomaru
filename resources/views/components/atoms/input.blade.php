@props(['label' => '', 'type' => 'text', 'name' => '', 'value' => '', 'autocomplete' => '', 'disabled' => false, 'required' => false])
<input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" autocomplete="{{ $autocomplete }}" {{ $disabled ? 'disabled' : '' }} {{$required ? 'required' : ''}}
            {!! $attributes->class(['shadow-sm border-gray-300' => !$disabled, 'shadow-none border-none' => $disabled])->merge(['class' => 'block w-full focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md']) !!}>
