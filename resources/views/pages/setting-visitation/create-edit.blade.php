@extends('layouts.app')
@php
use App\Models\Family;
const MEDIATION_CONDITION_PLACEHOLDER = <<<EOT
・子の福祉を考慮して自宅以外とする
・月1回、毎月第1土曜日の11～17時までとする
EOT;
const DESIRE_CONDITION_PLACEHOLDER = <<<EOT
・卵アレルギーのため、卵を含む食事をさせない
・高額なプレゼントやお小遣いを渡さない
EOT;
@endphp
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="面会交流設定" />
    <form action="" name="form" method="POST" class="space-y-4">
        @csrf
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    基本設定
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    {{-- <x-molecules.dd-dt label="面会交流の頻度(日)">
                        <x-atoms.input name="visitation_period" :value="$family->visitation_period" type="number" />
                        <p class="text-gray-500 text-xs">面会交流の頻度が少ない場合にメールで同居親に通知します。</p>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="面会交流の最大時間(時間)">
                        <x-atoms.input name="visitation_hour" :value="$family->visitation_hour" type="number" />
                        <p class="text-gray-500 text-xs">面会交流を登録する際に変更することも可能です。</p>
                    </x-molecules.dd-dt> --}}
                    <x-molecules.dd-dt label="両親の呼び方" required=true>
                        <x-atoms.radio name="parent_label" :option="[
                            Family::PARENT_LABEL_DOUKYOOYA => '同居親、別居親と呼ぶ',
                            Family::PARENT_LABEL_HAHAOYA => '同居親を母親、別居親を父親と呼ぶ',
                            Family::PARENT_LABEL_TITIOYA => '同居親を父親、別居親を母親と呼ぶ']"
                            checked="{{ $family->parent_label }}" required=true />
                        <p class="text-gray-500 text-xs">らえるでは名前は表示せず、こちらで指定した呼び方を利用します。</p>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="調停条件" x-data="{ isOpen: {{ $family->no_mediation_condition ? 'false' : 'true' }} }">
                        <x-atoms.checkbox name="no_mediation_condition" label="調停条件なし"
                            checked="{{ $family->no_mediation_condition }}" @click="isOpen = !isOpen" />
                        <x-atoms.textarea name="mediation_condition" :value="$family->mediation_condition" x-show="isOpen"
                            :placeholder="MEDIATION_CONDITION_PLACEHOLDER" />
                        <p class="text-gray-500 text-xs" x-show="isOpen">調停されていない場合は不要です。</p>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="希望条件">
                        <x-atoms.textarea name="desire_condition" :value="$family->desire_condition"
                            :placeholder="DESIRE_CONDITION_PLACEHOLDER" />
                        <p class="text-gray-500 text-xs">希望条件は面会毎に変更できます。</p>
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
        <x-molecules.button-area>
            <x-molecules.button-submit data-action="/setting-visitation">設定する</x-molecules.button-submit>
        </x-molecules.button-area>
    </form>
@endsection
