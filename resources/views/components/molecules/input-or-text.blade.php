@props(['editable' => true])
@if ($editable)
    <x-atoms.input {{ $attributes }} />
@else
    <p class="break-words w-full sm:text-sm">
        {{ $attributes['value'] }}
    </p>
@endif
