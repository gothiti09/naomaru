@props(['option' => [], 'selected' => '', 'placeholder' => null, 'name' => ''])
<select name="{{$name}}" {{ $attributes->merge(['class' => 'max-w-lg block focus:ring-gray-500 focus:border-gray-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md']) }}>
    @if($placeholder)
        <option value="" >{{ $placeholder }}</option>
    @endif
    @foreach ($option as $key => $value)
        <option value="{{ $key }}" {{ $key == old($name, $selected) ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
