@props(['rows' => 2, 'label' => '', 'type' => 'text', 'name' => '', 'value' => '', 'autocomplete' => '', 'disabled' => false, 'required' => false, 'placeholder' => ''])
<textarea rows="{{ $rows }}" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
    placeholder="{{ $placeholder }}" autocomplete="{{ $autocomplete }}" {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : '' }} {!! $attributes->class(['shadow-sm border-gray-300' => !$disabled, 'shadow-none border-none' => $disabled])->merge(['class' => 'py-3 px-4 block w-full focus:ring-gray-500 focus:border-gray-500 border rounded-md']) !!}>{!! old($name, e(str_replace('\n', "\n", $value))) !!}</textarea>
