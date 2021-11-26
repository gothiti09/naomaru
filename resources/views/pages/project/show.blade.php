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
    <form action="" name="form" method="POST" class="space-y-4">
        @csrf
        <x-molecules.breadcrumbs :links="[]" />
        <x-organisms.page-header title="募集登録" />
        <div class="bg-white shadow overflow-hidden rounded-md">
            <x-organisms.project :project="$project" :isList=false />
        </div>
        <div class="bg-white shadow overflow-hidden rounded-md">
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            募集内容
                        </h3>
                    </div>
                    <x-molecules.dd-dt label="募集タイトル">
                        <x-atoms.text>{{ $project->title }}</x-atoms.text>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="募集詳細">
                        <x-atoms.text>{{ $project->description }}</x-atoms.text>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="加工のステージ">
                        @foreach ($project->stages as $stage)
                            <x-molecules.status-badge color="primary" text="{{ $stage->title }}" />
                        @endforeach
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="想定の加工方法">
                        @foreach ($project->methods as $method)
                            <x-molecules.status-badge color="primary" text="{{ $method->title }}" />
                        @endforeach
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="添付ファイル">
                        <p class="text-gray-500 text-xs">※ 添付する際、機密情報に当たる内容は掲載しないでください。見積できる最低限の情報のみを添付下さい</p>
                        <p class="text-gray-500 text-xs">例.図面は重要寸法部や公差の厳しい部分だけ記載するなど</p>
                        <p class="text-gray-500 text-xs">※ 1ファイル10MBまで。5ファイルまで。</p>
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    募集条件
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="予算">
                        <x-atoms.text>{{ $project->budget }}</x-atoms.text>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="希望納期">
                        <x-atoms.text>{{ $project->desired_delivery_at->format('Y年m月d日') }}</x-atoms.text>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="提案期限">
                        <x-atoms.text>{{ $project->close_at->format('Y年m月d日') }}</x-atoms.text>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="納品場所">
                        <x-atoms.text>{{ $project->deliveryPrefecture->name }}</x-atoms.text>
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
        <div class="flex flex-col items-center">
            <x-molecules.button-area>
                <x-molecules.button-submit method="GET" data-action="{{ route('proposal.create', ['project_uuid' => $project->uuid]) }}">
                    提案する
                </x-molecules.button-submit>
            </x-molecules.button-area>
        </div>
    </form>
@endsection
