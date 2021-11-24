@extends('layouts.app')
@php
$residentParentLabel = Auth::user()->residentParentLabel();
$nonResidentParentLabel = Auth::user()->nonResidentParentLabel();
@endphp
@section('content')
    @if (!Auth::user()->finish_onboarding_at && Auth::user()->isNonResidentParent())
        <x-molecules.icon-description title="はじめまして！らえるへようこそ！"
            description='らえるは同居親と別居親と連絡先を交換することなく、面会交流の調整ができて、第三者も確認できる面会交流支援サービスです。<br>はじめにサービスを使うための基本情報を設定してください。設定は後から変更できます。'>
            <x-atoms.svg-cake size="xl" viewBox="24" />
        </x-molecules.icon-description>
    @else
        <x-molecules.breadcrumbs :links="[]" />
        <x-organisms.page-header title="{{ $nonResidentParentLabel }}設定" />
    @endif
    <form action="" name="form" method="POST" class="space-y-4">
        @csrf
        <div x-show="type=='mail'">
            <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        基本設定
                    </h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <x-molecules.dd-dt label="メールアドレス" required=true>
                            <x-atoms.input name="email" :value="$user->email" type="email" required=true />
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="名前" required=true>
                            <x-atoms.input name="name" :value="$user->name" required=true />
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="名前フリガナ" required=true>
                            <x-atoms.input name="kana" :value="$user->kana" required=true />
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="電話番号" required=true>
                            <x-atoms.input name="tel" :value="$user->tel" type="tel" required=true />
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="性別" required=true>
                            <x-atoms.select name="sex" :option="['1' => '男性', '2' => '女性', '9' => 'その他']"
                                selected="{{ $user->sex }}" placeholder="選択してください" required=true />
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="年代" required=true>
                            <x-atoms.select name="age_range"
                                :option="['10' => '10代', '20' => '20代', '30' => '30代', '40' => '40代', '50' => '50代', '60' => '60代', ]"
                                selected="{{ $user->age_range }}" placeholder="選択してください" required=true />
                        </x-molecules.dd-dt>
                    </dl>
                </div>
            </div>
            @if (Auth::user()->finish_onboarding_at)
                <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            通知設定
                        </h3>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <x-molecules.dd-dt label="面会交流日時・場所の確定" required=true>
                                <x-atoms.radio name="alert_schedule" :option="['1' => '通知する', '0' => '通知しない']"
                                    checked="{{ $user->alert_schedule }}" required=true />
                            </x-molecules.dd-dt>
                            <x-molecules.dd-dt label="当日アクション" required=true>
                                <x-atoms.radio name="alert_action" :option="['1' => '通知する', '0' => '通知しない']"
                                    checked="{{ $user->alert_action }}" required=true />
                            </x-molecules.dd-dt>
                            <x-molecules.dd-dt label="面会交流報告" required=true>
                                <x-atoms.radio name="alert_report" :option="['1' => '通知する', '0' => '通知しない']"
                                    checked="{{ $user->alert_report }}" required=true />
                            </x-molecules.dd-dt>
                            <x-molecules.dd-dt label="緊急連絡" required=true>
                                <x-atoms.radio name="alert_message" :option="['1' => '通知する', '0' => '通知しない']"
                                    checked="{{ $user->alert_message }}" required=true />
                            </x-molecules.dd-dt>
                        </dl>
                    </div>
                </div>
            @endif
        </div>
        <x-molecules.button-area>
            @if (!Auth::user()->finish_onboarding_at && Auth::user()->isNonResidentParent())
                <x-molecules.button-submit data-action="/setting-non-resident-parent">
                    登録する
                </x-molecules.button-submit>
            @elseif ($user->exists)
                <x-molecules.button-submit method="PUT" data-action="/setting-non-resident-parent/{{ $user->id }}">
                    変更する
                </x-molecules.button-submit>
            @endif
        </x-molecules.button-area>
    </form>
@endsection
