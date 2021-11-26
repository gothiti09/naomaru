@extends('layouts.app')
@php
@endphp
@section('content')
    <x-organisms.page-header title="募集" create="{{ route('project.create') }}" />
    @if ($projects?->count())
        <div class="bg-white shadow overflow-hidden rounded-md">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach ($projects as $project)
                    <li>
                        <a href="{{ route('project.edit', $project->uuid) }}" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 sm:px-6 space-y-2">
                                <div class="flex items-center justify-between">
                                    <p class="text-lg font-bold text-gray-900 truncate">
                                        {{ $project->title }}
                                    </p>
                                </div>
                                <div class="ml-2 flex flex-wrap justify-around gap-y-2">
                                    <div class="flex flex-col items-center sm:w-1/4 w-1/2">
                                        <x-molecules.status-badge color="red" text="提案期限" />
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $project->close_at->format('Y年m月d日') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-center sm:w-1/4 w-1/2">
                                        <x-molecules.status-badge color="gray" text="希望予算" />
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $project->budget }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-center sm:w-1/4 w-1/2">
                                        <x-molecules.status-badge color="gray" text="希望納期" />
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $project->desired_delivery_at->format('Y年m月d日') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-center sm:w-1/4 w-1/2">
                                        <x-molecules.status-badge color="gray" text="納品場所" />
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $project->deliveryPrefecture->name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $project->description }}
                                    </p>
                                </div>
                                <div class="ml-2 flex-wrap flex gap-1 mt-2">
                                    @foreach ($project->stages as $stage)
                                        <x-molecules.status-badge color="primary" text="{{ $stage->title }}" />
                                    @endforeach
                                    @foreach ($project->methods as $method)
                                        <x-molecules.status-badge color="primary" text="{{ $method->title }}" />
                                    @endforeach
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between items-end">
                                    <p class="flex items-center text-sm text-gray-500">
                                        <svg class="mr-1.5 h-5 w-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $project->open_at?->isoFormat('Y年M月D日(ddd) H:mm') }}
                                    </p>
                                    <div>
                                        <p class="flex items-center text-sm text-gray-500 mt-0">
                                            {{ $project->company->name }}
                                        </p>
                                        <p class="flex items-center text-sm text-gray-500 mt-0">
                                            {{ $project->createdBy->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-gray-500 text-sm text-center">募集はまだ登録されていません。</p>
    @endif
    <x-organisms.page-header title="提案" />
    @if ($proposals?->count())
        <div class="bg-white shadow overflow-hidden rounded-md">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach ($proposals as $proposal)
                    <li>
                        <a href="{{ route('proposal.edit', $proposal->uuid) }}" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-indigo-600 truncate">
                                        面会交流
                                    </p>
                                    <div class="ml-2 flex">
                                        <x-molecules.status-badge :proposal="$proposal" />
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <p class="flex items-center text-sm text-gray-500">
                                        <!-- Heroicon name: solid/users -->
                                        <svg class="mr-1.5 h-5 w-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $proposal->scheduled_start_at?->isoFormat('M月D日(ddd) H:mm') }} -
                                        {{ $proposal->scheduled_end_at?->isoFormat('M月D日(ddd) H:mm') }}
                                    </p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                        <!-- Heroicon name: solid/location-marker -->
                                        <svg class="mr-1.5 h-5 w-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $proposal->main_point }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-gray-500 text-sm text-center">提案はありません。</p>
        <p class="text-gray-500 text-sm text-center">募集一覧から提案してください。</p>
    @endif
@endsection
