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
                        <a href="{{ route('project.show', $project->uuid) }}" class="block hover:bg-gray-50">
                            <x-organisms.project :project="$project" />
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
                                        <svg class="mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $proposal->scheduled_start_at?->isoFormat('M月D日(ddd) H:mm') }} -
                                        {{ $proposal->scheduled_end_at?->isoFormat('M月D日(ddd) H:mm') }}
                                    </p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                        <!-- Heroicon name: solid/location-marker -->
                                        <svg class="mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
