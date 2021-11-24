@props(['method' => 'POST'])
<x-atoms.button-primary {{ $attributes }} size="xl" round="true" class="submit" data-validate=true
    data-method="{{ $method }}">
    {{ $slot }}
</x-atoms.button-primary>
