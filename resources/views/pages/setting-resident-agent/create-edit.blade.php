@extends('layouts.app')
@php
$residentAgentLabel = Auth::user()->residentAgentLabel();
@endphp
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="同居親代理人（{{ $residentAgentLabel }}）設定" />
    <form action="" name="form" method="POST" class="space-y-4">
        @csrf
        <x-molecules.icon-description title="同居親代理人とは何ですか？"
            description='同居親が精神的な理由や時間的な都合などで、別居親との面会交流の調整が難しい場合に、代理人が代わりに操作できます。<br>同居親の両親や弁護士などを設定してください。'>
            <x-atoms.svg-question size="xl" viewBox="24" />
        </x-molecules.icon-description>

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
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    閲覧権限設定
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="面会交流報告" required=true>
                        <x-atoms.radio name="read_report" :option="['1' => '閲覧できる', '0' => '閲覧できない']"
                            checked="{{ $user->read_report }}" required=true />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="緊急連絡" required=true>
                        <x-atoms.radio name="read_message" :option="['1' => '閲覧できる', '0' => '閲覧できない']"
                            checked="{{ $user->read_message }}" required=true />
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
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
        <x-molecules.button-area>
            @if ($user->exists)
                <x-molecules.button-submit method="PUT" data-action="/setting-resident-agent/{{ $user->id }}">
                    変更する
                </x-molecules.button-submit>
                <x-molecules.modal-button action="{{ route('setting-resident-agent.destroy', $user->id) }}"
                    method="DELETE" validate="false" color="red" buttonName="削除する" confirmTitle="削除しますか？"
                    confirmText="削除すると戻せません。" />
            @else
                <x-molecules.modal-button action="/setting-resident-agent" buttonName="登録する" confirmTitle="登録しますか？"
                    confirmText="同居親代理人にらえるログインURLを記載したメールが送信されます。" />
            @endif
        </x-molecules.button-area>
    </form>
@endsection
