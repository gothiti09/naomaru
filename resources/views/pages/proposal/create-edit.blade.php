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
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="提案登録" />
    <form action="" name="form" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="project_uuid" value="{{ $project->uuid }}" />
        <div class="bg-white shadow overflow-hidden rounded-md">
            <x-organisms.project :project="$project" :isList=false />
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
                        <x-atoms.textarea name="description" :value="$proposal->description ?? DESCRIPTION" rows=8 />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="添付ファイル">
                        <p class="text-gray-500 text-xs">※ 添付する際、機密情報に当たる内容は掲載しないでください。見積できる最低限の情報のみを添付下さい</p>
                        <p class="text-gray-500 text-xs">例.図面は重要寸法部や公差の厳しい部分だけ記載するなど</p>
                        <p class="text-gray-500 text-xs">※ 1ファイル10MBまで。5ファイルまで。</p>
                    </x-molecules.dd-dt>

                </dl>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="概算予算" required=true>
                        <div class="mt-2 flex sm:flex-row gap-2 flex-col items-center justify-items-stretch">
                            <x-atoms.input name="budget" class="w-2/3" :value="$proposal->min_budget"
                                type="number" />
                        </div>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="予定納期" required=true>
                        <x-atoms.input name="delivery_at" :value="$proposal->desired_delivery_at" required=true
                            type="date" />
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
        <div class="flex flex-col items-center">
            <x-molecules.button-area>
                <x-molecules.button-submit method="POST" data-action="{{ route('proposal.store') }}">
                    提案する
                </x-molecules.button-submit>
            </x-molecules.button-area>
        </div>
    </form>
@endsection
