@props(['editable' => true])
@if ($editable)
    <x-atoms.textarea {{ $attributes }} />
@else
    <p class="break-words w-full sm:text-sm">
        {!! nl2br(e($attributes['value']))  !!}
    </p>
@endif
