@props(['editable' => true])
@if ($editable)
    <x-atoms.input {{ $attributes }} />
@else
    <p class="break-words w-full sm:text-sm underline">
        <a href="{{ $attributes['value'] }}" target="_blank">
            {{ $attributes['value'] }}
        </a>
    </p>
@endif
