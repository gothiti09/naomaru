@props(['editable' => true])
@if ($editable)
    <x-atoms.input {{ $attributes }} />
@else
    <p class="break-words w-full sm:text-sm">
        {{ $attributes['value'] ? \Carbon\Carbon::parse($attributes['value'])->isoFormat('M月D日(ddd) H:mm') : '' }}
    </p>
@endif
