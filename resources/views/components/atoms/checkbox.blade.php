@props(['label' => '', 'name' => '', 'checked' => false, 'disabled' => false])
<div class="flex items-center">
    @if ($checked)
        {{--
            checkboxはOFFにすると、リクエストに含まれない（本当は0が含まれてほしい）。
            そのためチェックONの場合に、チェックOFFにするためにはhiddenで0を送る必要がある。
            チェックONのままなら下のinputのチェックONで上書きされるので問題ない。
        --}}
        <input type="hidden" name="{{ $name }}" value="0" />
    @endif
    <input id="{{ $name }}" name="{{ $name }}" {{ $checked ? 'checked' : '' }} {{ $attributes }}
        {{ $disabled ? 'disabled' : '' }} type="checkbox" value="1"
        class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
    <label for="{{ $name }}"
        {{ $attributes->merge(['class' => 'ml-3 block text-sm font-medium text-gray-700']) }}>
        {{ $label }}
    </label>
</div>
