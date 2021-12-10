@extends('layouts.app')
@php
@endphp
@section('content')
    <x-organisms.page-header title="提案可能な募集一覧" create="{{ route('project.create') }}" buttonName="新しい募集を作成" />
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
@endsection
