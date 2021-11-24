<div class="bg-white shadow overflow-hidden rounded-lg mb-4">
    <div class="px-4 py-5 sm:px-6">
        <div class="flex items-center mb-2">
            {{ $slot }}
            <p class="ml-2">{{ $title }}</p>
        </div>
        <p class="text-sm">{!! $description !!}</p>
    </div>
</div>
