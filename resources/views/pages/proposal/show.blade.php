@extends('layouts.app')
@php
const DESCRIPTION = <<<EOT
【概要】
XXX

【数量（個数・ロット数・式数など）】
XXX個
EOT;
@endphp
@section('content')
    <div class="space-y-4">
        <x-molecules.breadcrumbs :links="[]" />
        <x-organisms.page-header title="提案" />
        <form action="" name="form" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="project_uuid" value="{{ $project->uuid }}" />
            <div class="bg-white shadow overflow-hidden rounded-md">
                <x-organisms.proposal :proposal="$proposal" />
            </div>
            <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        提案内容
                    </h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <x-molecules.dd-dt label="提案詳細" required=true>
                            <x-atoms.text>{{ $proposal->description }}</x-atoms.text>
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="添付ファイル">
                            @foreach ($proposal->proposalFiles as $proposalFile)
                                <x-atoms.link href="{{ route('proposal-file.download', $proposalFile->uuid) }}">
                                    {{ $proposalFile->name }}
                                </x-atoms.link>
                                <br>
                            @endforeach
                        </x-molecules.dd-dt>

                    </dl>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <x-molecules.dd-dt label="概算予算" required=true>
                            <div class="mt-2 flex sm:flex-row gap-2 flex-col items-center justify-items-stretch">
                                <x-atoms.text>{{ $proposal->budget_text }}</x-atoms.text>
                            </div>
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="予定納期" required=true>
                            <x-atoms.text>{{ $proposal->delivery_at->format('Y年m月d日') }}</x-atoms.text>
                        </x-molecules.dd-dt>
                    </dl>
                </div>
            </div>
            <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        会社概要
                    </h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <x-molecules.dd-dt label="会社名" required=true>
                            <x-atoms.text>{{ $proposal->company->name }}</x-atoms.text>
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="所在地" required=true>
                            <x-atoms.text>{{ $proposal->user->prefecture?->name }}</x-atoms.text>
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="自己紹介" required=true>
                            <x-atoms.text>{{ $proposal->user->description }}</x-atoms.text>
                        </x-molecules.dd-dt>
                    </dl>
                </div>
            </div>
            @if (!$proposal->request_meeting_at)
                <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <x-molecules.dd-dt label="希望日時1" required=true>
                            <x-atoms.input name="desired_1_meeting_at" :value="$proposal->desired_1_meeting_at"
                                required=true type="datetime-local" />
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="希望日時2">
                            <x-atoms.input name="desired_2_meeting_at" :value="$proposal->desired_2_meeting_at"
                                type="datetime-local" />
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="希望日時3">
                            <x-atoms.input name="desired_3_meeting_at" :value="$proposal->desired_3_meeting_at"
                                type="datetime-local" />
                        </x-molecules.dd-dt>
                    </dl>
                </div>
                <div class="flex flex-col items-center">
                    <x-molecules.button-area>
                        <x-molecules.button-submit method="PUT"
                            data-action="{{ route('proposal.request-meeting', $proposal->uuid) }}">
                            Web面談を依頼する
                        </x-molecules.button-submit>
                    </x-molecules.button-area>
                </div>
            @endif
        </form>
        <x-organisms.page-header title="この提案の募集" />
        <div class="bg-white shadow overflow-hidden rounded-md">
            <a href="{{ route('project.show', $project->uuid) }}" class="block hover:bg-gray-50">
                <x-organisms.project :project="$project" :isList=false />
            </a>
        </div>
    </div>
@endsection
