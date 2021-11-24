@props(['title', 'search' => false, 'create' => false, 'keyword' => ''])

<div class="pb-5 mb-5 border-b border-gray-200 flex items-center justify-between mt-3">
    <h3 class="text-xl leading-6 font-medium text-gray-900">
        {{ $title }}
    </h3>
    <div class="flex items-center justify-between">
        @if ($search)
            <form id="form" action="{{ $search }}" method="GET">
                <x-molecules.input-text-icon class="mt-3 mt-0 ml-3" name="keyword" placeholder="キーワード"
                    value="{{ $keyword }}"
                    icon="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
            </form>
        @endif
        @if ($create)
            <x-atoms.button-primary round="true" size="xl" data-href="{{ $create }}" data-method="GET"
                class="mt-3 mt-0 ml-3 submit">
                <x-atoms.svg-plus size="xl" />
                追加
            </x-atoms.button-primary>
        @endif
    </div>
</div>
