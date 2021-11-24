@props(['label' => ''])
<div class="relative">
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-gray-300"></div>
    </div>
    @if ($label)
        <div class="relative flex justify-center">
            <span class="px-2 bg-gray-800 text-sm text-gray-300">
                {{ $label }}
            </span>
        </div>
    @endif
</div>
