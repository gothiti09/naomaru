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
    <x-organisms.page-header title="募集登録" />
    <form action="" name="form" method="POST" class="space-y-4" x-data="{ showButton:false, openBudget: {{ $project->budget_undecided ? 'false' : 'true' }} }">
        @csrf
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    募集内容
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="募集タイトル" required=true>
                        <x-atoms.input name="title" :value="$project->title" required=true />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="提案内容">
                        <x-atoms.textarea name="description" :value="$project->description ?? DESCRIPTION"
                            placeholder="自社の特徴や強みなどをご記入ください。" rows=8 />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="加工のステージ">
                        @foreach ($stages as $stage)
                            <x-atoms.checkbox name="stages[{{ $stage->id }}]" label="{{ $stage->title }}"
                                checked="{{ $project->stages?->contains('project_id', $stage->id) }}" />
                        @endforeach
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="想定の加工方法">
                        @foreach ($methods as $method)
                            <x-atoms.checkbox name="methods[{{ $method->id }}]" label="{{ $method->title }}"
                                checked="{{ $project->methods?->contains('project_id', $method->id) }}" />
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
                    <x-molecules.dd-dt label="予算"
                        required=true>
                        <x-atoms.checkbox @click="openBudget=!openBudget" name="budget_undecided" label="予算未定"
                            checked="{{ $project->budget_undecided }}" />
                        <div class="mt-2 flex sm:flex-row gap-2 flex-col items-center justify-items-stretch"
                            x-show="openBudget">
                            <div class="flex flex-col items-left sm:w-1/2 w-full">
                                <p class="text-gray-500 text-xs whitespace-nowrap w-1/3 text-left">希望上限予算（円）</p>
                                <x-atoms.input name="min_budget" class="w-2/3" :value="$project->min_budget"
                                    type="number" />
                            </div>
                            <div class="flex flex-col items-left sm:w-1/2 w-full">
                                <p class="text-gray-500 text-xs whitespace-nowrap w-1/3 text-left">希望下限予算（円）</p>
                                <x-atoms.input name="max_budget" class="w-2/3" :value="$project->max_budget"
                                    type="number" />
                            </div>
                        </div>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="希望納期" required=true>
                        <x-atoms.input name="desired_delivery_at" :value="$project->deesired_delivery_at" required=true
                            type="datetime-local" />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="提案期限" required=true>
                        <x-atoms.input name="close_at" :value="$project->close_at" required=true type="datetime-local" />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="納品場所" required=true>
                        <x-atoms.select name="delivery_prefecture_code" :option="$prefectures->pluck('name', 'code')"
                            selected="{{ $project->delivery_prefecture_code ?? '' }}" placeholder="選択してください"
                            required=true />
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
        <div class="flex flex-col items-center">
            <x-atoms.checkbox @click="showButton=!showButton" name="agree" label="依頼内容に機密情報が含まれていないことを確認しました。" />
            <x-molecules.button-area x-show="showButton">
                <x-molecules.button-submit method="POST" data-action="{{ route('project.store') }}">
                    募集する
                </x-molecules.button-submit>
            </x-molecules.button-area>
        </div>
    </form>
@endsection
