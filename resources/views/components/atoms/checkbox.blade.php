@props(['label' => '', 'name' => '', 'id' => '', 'value' => '1', 'checked' => false, 'disabled' => false])
<div class="flex items-center">
    @if ($checked)
        {{-- checkboxはOFFにすると、リクエストに含まれない（本当は0が含まれてほしい）。
            そのためチェックONの場合に、チェックOFFにするためにはhiddenで0を送る必要がある。
            チェックONのままなら下のinputのチェックONで上書きされるので問題ない。 --}}
        <input type="hidden" name="{{ $name }}" value="0" />
    @endif

    <label for="{{ $id }}"
        {{ $attributes->merge(['class' => 'ml-3 block text-sm font-medium text-gray-700']) }}>
        <input id="{{ $id }}"name="{{ $name }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }} {{ $attributes }}
            {{ $disabled ? 'disabled' : '' }} type="checkbox" value="1"
            class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
        <span>{{ $label }}</span>
    </label>
</div>
