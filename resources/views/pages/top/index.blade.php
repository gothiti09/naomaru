@extends('layouts.app')
@php
@endphp
@section('content')
        <x-organisms.page-header title="自分の募集一覧" create="{{ route('project.create') }}" />
        @if ($projects?->count())
            <div class="bg-white shadow overflow-hidden rounded-md mb-10">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach ($projects as $project)
                        <li>
                            <a href="{{ route('project.show', $project->uuid) }}" class="block hover:bg-primary-50">
                                <x-organisms.project :project="$project" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="text-gray-500 text-sm text-center">募集はまだ登録されていません。</p>
        @endif
        <x-organisms.page-header title="自分の提案一覧" />
        @if ($proposals?->count())
            <div class="bg-white shadow overflow-hidden rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach ($proposals as $proposal)
                        <li>
                            <a href="{{ route('proposal.show', $proposal->uuid) }}" class="block hover:bg-primary-50">
                                <x-organisms.proposal :proposal="$proposal" />
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
