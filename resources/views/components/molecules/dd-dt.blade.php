@props(['label' => '', 'type' => 'text', 'name' => '', 'value' => '', 'autocomplete' => '', 'required' => false, 'disabled' => false])
<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6" {{ $attributes }}>
    <dt class="text-sm font-medium text-gray-500">
        {{ $label }}
        @if ($required && !$disabled)
            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                必須
            </p>
        @endif
    </dt>
    <dd class="mt-1 text-lg text-gray-900 sm:mt-0 sm:col-span-2">
        {{ $slot }}
    </dd>
</div>
