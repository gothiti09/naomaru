@props(['proposal', 'isList' => true])
<div class="px-4 py-4 sm:px-6 space-y-2">
    <div class="flex items-center justify-start gap-2">
        @if ($proposal->request_meeting_at)
            <x-molecules.status-badge color="green" text="相談済み" />
        @elseif ($proposal->project->close_at->lt(today()))
            <x-molecules.status-badge color="gray" text="期限切れ" />
        @else
            <x-molecules.status-badge color="red" text="提案中" />
        @endif
        <p class="text-lg font-bold text-gray-900 truncate">
            {{ $proposal->project->title }}
        </p>
    </div>
    <div class="ml-2 flex flex-wrap justify-start gap-y-2">
        <div class="flex flex-col items-center sm:w-1/4 w-1/2">
            <x-molecules.label-badge color="gray" text="提案金額" />
            <p class="text-lg font-medium text-gray-900 truncate">
                {{ $proposal->budget_text }}
            </p>
        </div>
        <div class="flex flex-col items-center sm:w-1/4 w-1/2">
            <x-molecules.label-badge color="gray" text="提案納期" />
            <p class="text-lg font-medium text-gray-900 truncate">
                {{ $proposal->delivery_at->format('Y年m月d日') }}
            </p>
        </div>
    </div>
    <div class="mt-2 sm:flex sm:justify-between items-end">
        <p class="flex items-center text-sm text-gray-500">
            <svg class="mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                    clip-rule="evenodd" />
            </svg>
            {{ $proposal->proposal_at?->isoFormat('Y年M月D日(ddd) H:mm') }}
        </p>
        <div>
            <x-molecules.status-badge color="{{ $proposal->createdBy->auditRank->color }}" text="{{ $proposal->createdBy->auditRank->title }}" />
            <p class="flex items-center text-sm text-gray-500 mt-0">
                {{ $proposal->company->name }}
            </p>
            <p class="flex items-center text-sm text-gray-500 mt-0">
                {{ $proposal->createdBy->name }}
            </p>
        </div>
    </div>
</div>
