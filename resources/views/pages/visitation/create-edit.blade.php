@extends('layouts.app')
@php
$residentParentLabel = Auth::user()->residentParentLabel();
$nonResidentParentLabel = Auth::user()->nonResidentParentLabel();
@endphp
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="面会交流" />
    <form action="" name="form" method="POST" class="space-y-4">
        @csrf
        @if (($visitation->isEnd() && Auth::user()->isNonResidentRole()) || $visitation->isReport())
            <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        完了報告
                    </h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <x-molecules.dd-dt label="各条件を遵守しましたか。">
                            @if (isset($visitation->comply))
                                @if ($visitation->comply)
                                    <p class="text-gray-900 text-base">遵守しました。</p>
                                @else
                                    <p class="text-gray-900 text-base">遵守できませんでした。</p>

                                @endif
                            @else
                                <x-atoms.radio name="comply" :option="['1' => '遵守しました', '0' => '遵守できませんでした']"
                                    checked="{{ $visitation->comply }}" required=true
                                    :disabled="$visitation->isReport()" />
                            @endif
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="遵守できなかった理由">
                            <x-molecules.textarea-or-text name="comply_description" :value="$visitation->comply_description"
                                :editable="!$visitation->isReport()" />
                        </x-molecules.dd-dt>
                        <x-molecules.dd-dt label="その他報告">
                            <x-molecules.textarea-or-text name="report_description" :value="$visitation->report_description"
                                :editable="!$visitation->isReport()" />
                        </x-molecules.dd-dt>
                    </dl>
                    @if ($visitation->isEnd() && Auth::user()->isNonResidentRole())
                        <x-molecules.button-area>
                            <x-molecules.button-submit method="PUT"
                                data-action="/visitation/{{ $visitation->uuid }}/report">
                                完了報告する
                            </x-molecules.button-submit>
                        </x-molecules.button-area>
                    @endif
                </div>
            </div>
        @endif
        <x-molecules.button-area>
            @if ($visitation->isScheduleFix() && Auth::user()->isNonResidentRole())
                <x-molecules.button-submit method="PUT" data-action="/visitation/{{ $visitation->uuid }}/start">
                    面会を開始する
                </x-molecules.button-submit>
            @endif
            @if ($visitation->isStart() && Auth::user()->isNonResidentRole())
                <x-molecules.button-submit method="PUT" data-action="/visitation/{{ $visitation->uuid }}/end">
                    面会を終了する
                </x-molecules.button-submit>
            @endif
        </x-molecules.button-area>
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    時間
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    @if (!$visitation->finishScheduleFix())
                        <x-molecules.dd-dt label="第一候補日時" required=true
                            :disabled="!$visitation->canEditBeforeScheduleFix()">
                            <div class="flex sm:flex-row gap-1 flex-col items-center justify-items-stretch">
                                <div class="flex items-center sm:w-1/2 w-full">
                                    <p class="text-gray-500 text-base whitespace-nowrap w-1/3 text-right">開始：</p>
                                    <x-molecules.input-or-datetime name="possible_start_1_at" class="w-2/3"
                                        :value="$visitation->possible_start_1_at"
                                        type="datetime-local" required=true
                                        :editable="$visitation->canEditBeforeScheduleFix()" />
                                </div>
                                <div class="flex items-center sm:w-1/2 w-full">
                                    <p class="text-gray-500 text-base whitespace-nowrap w-1/3 text-right">終了：</p>
                                    <x-molecules.input-or-datetime name="possible_end_1_at" class="w-2/3"
                                        :value="$visitation->possible_end_1_at"
                                        type="datetime-local" required=true
                                        :editable="$visitation->canEditBeforeScheduleFix()" />
                                </div>
                            </div>
                        </x-molecules.dd-dt>
                        @if ($visitation->visbleOnEdit($visitation->possible_start_2_at))
                            <x-molecules.dd-dt label="第二候補日時">
                                <div class="flex sm:flex-row gap-1 flex-col items-center justify-items-stretch">
                                    <div class="flex items-center sm:w-1/2 w-full">
                                        <p class="text-gray-500 text-base whitespace-nowrap w-1/3 text-right">開始：</p>
                                        <x-molecules.input-or-datetime name="possible_start_2_at" class="w-2/3"
                                            :value="$visitation->possible_start_2_at"
                                            type="datetime-local" :editable="$visitation->canEditBeforeScheduleFix()" />
                                    </div>
                                    <div class="flex items-center sm:w-1/2 w-full">
                                        <p class="text-gray-500 text-base whitespace-nowrap w-1/3 text-right">終了：</p>
                                        <x-molecules.input-or-datetime name="possible_end_2_at" class="w-2/3"
                                            :value="$visitation->possible_end_2_at"
                                            type="datetime-local" :editable="$visitation->canEditBeforeScheduleFix()" />
                                    </div>
                                </div>
                            </x-molecules.dd-dt>
                        @endif
                        @if ($visitation->visbleOnEdit($visitation->possible_start_3_at))
                            <x-molecules.dd-dt label="第三候補日時">
                                <div class="flex sm:flex-row gap-1 flex-col items-center justify-items-stretch">
                                    <div class="flex items-center sm:w-1/2 w-full">
                                        <p class="text-gray-500 text-base whitespace-nowrap w-1/3 text-right">開始：</p>
                                        <x-molecules.input-or-datetime name="possible_start_3_at" class="w-2/3"
                                            :value="$visitation->possible_start_3_at"
                                            type="datetime-local" :editable="$visitation->canEditBeforeScheduleFix()" />
                                    </div>
                                    <div class="flex items-center sm:w-1/2 w-full">
                                        <p class="text-gray-500 text-base whitespace-nowrap w-1/3 text-right">終了：</p>
                                        <x-molecules.input-or-datetime name="possible_end_3_at" class="w-2/3"
                                            :value="$visitation->possible_end_3_at"
                                            type="datetime-local" :editable="$visitation->canEditBeforeScheduleFix()" />
                                    </div>
                                </div>
                            </x-molecules.dd-dt>
                        @endif
                        @if ($visitation->visbleOnEdit($visitation->hour))
                            <x-molecules.dd-dt label="最大時間(時間)" :disabled="!$visitation->canEditBeforeScheduleFix()">
                                <x-molecules.input-or-text name="hour" :value="$visitation->hour" type="number"
                                    :editable="$visitation->canEditBeforeScheduleFix()" />
                            </x-molecules.dd-dt>
                        @endif
                    @endif
                    @if ($visitation->visbleScheduledTime())
                        <x-molecules.dd-dt label="集合・解散時間">
                            <div class="flex sm:flex-row gap-1 flex-col items-center justify-items-stretch">
                                <div class="flex items-center sm:w-1/2 w-full">
                                    <p class="text-gray-500 text-base whitespace-nowrap w-1/3 text-right">集合：</p>
                                    <x-molecules.input-or-datetime name="scheduled_start_at" class="w-2/3"
                                        :value="$visitation->scheduled_start_at"
                                        type="datetime-local" required=true
                                        :editable="$visitation->isEditableFixSchedule()" />
                                </div>
                                <div class="flex items-center sm:w-1/2 w-full">
                                    <p class="text-gray-500 text-base whitespace-nowrap w-1/3 text-right">解散：</p>
                                    <x-molecules.input-or-datetime name="scheduled_end_at" class="w-2/3"
                                        :value="$visitation->scheduled_end_at"
                                        type="datetime-local" required=true
                                        :editable="$visitation->isEditableFixSchedule()" />
                                </div>
                            </div>
                        </x-molecules.dd-dt>
                    @endif
                </dl>
                @if ($visitation->isToBeScheduled() && Auth::user()->isNonResidentRole())
                    <x-molecules.button-area>
                        <x-molecules.button-submit method="PUT"
                            data-action="{{ route('visitation.fix-schedule', $visitation->uuid) }}">
                            日程を確定する
                        </x-molecules.button-submit>
                        <x-molecules.modal-button action="{{ route('visitation.cancel', $visitation->uuid) }}"
                            method="PUT" validate="false" color="gray" buttonName="予定が合わないのでキャンセル" confirmTitle="キャンセルしますか？"
                            confirmText="予定が合わない場合は、こちらの面会交流はキャンセルとなります。次の面会交流が登録されるまでお待ちください。" />
                    </x-molecules.button-area>
                @endif
            </div>
        </div>
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        場所
                    </h3>
                    {{-- <div class="flex justify-center">
                        <x-button-secondary-base data-action="/" data-validate=true data-method="POST">
                            全てリセット
                        </x-button-secondary-base>
                    </div> --}}
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="集合場所" required=true :disabled="!$visitation->canEditBeforeScheduleFix()">
                        <x-molecules.input-or-text name="start_point" :value="$visitation->start_point" required=true
                            :editable="$visitation->canEditBeforeScheduleFix()" />
                    </x-molecules.dd-dt>
                    @if ($visitation->visbleOnEdit($visitation->start_point_url))
                        <x-molecules.dd-dt label="集合場所URL">
                            <x-molecules.input-or-link name="start_point_url" :value="$visitation->start_point_url"
                                :editable="$visitation->canEditBeforeScheduleFix()" />
                        </x-molecules.dd-dt>
                    @endif
                    <x-molecules.dd-dt label="面会場所" required=true :disabled="!$visitation->canEditBeforeScheduleFix()">
                        <x-molecules.input-or-text name="main_point" :value="$visitation->main_point" required=true
                            :editable="$visitation->canEditBeforeScheduleFix()" />
                    </x-molecules.dd-dt>
                    @if ($visitation->visbleOnEdit($visitation->main_point_url))
                        <x-molecules.dd-dt label="面会場所URL">
                            <x-molecules.input-or-link name="main_point_url" :value="$visitation->main_point_url"
                                :editable="$visitation->canEditBeforeScheduleFix()" />
                        </x-molecules.dd-dt>
                    @endif
                    <x-molecules.dd-dt label="解散場所" required=true :disabled="!$visitation->canEditBeforeScheduleFix()">
                        <x-molecules.input-or-text name="end_point" :value="$visitation->end_point" required=true
                            :editable="$visitation->canEditBeforeScheduleFix()" />
                    </x-molecules.dd-dt>
                    @if ($visitation->visbleOnEdit($visitation->end_point_url))
                        <x-molecules.dd-dt label="解散場所URL">
                            <x-molecules.input-or-link name="end_point_url" :value="$visitation->end_point_url"
                                :editable="$visitation->canEditBeforeScheduleFix()" />
                        </x-molecules.dd-dt>
                    @endif
                </dl>
            </div>
        </div>
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    その他
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="連絡事項">
                        <x-molecules.textarea-or-text name="information" :value="$visitation->information"
                            :editable="$visitation->canEditBeforeScheduleFix()" />
                    </x-molecules.dd-dt>
                    @if ($visitation->mediation_condition)
                        <x-molecules.dd-dt label="調停条件">
                            <x-molecules.textarea-or-text name="mediation_condition"
                                :value="$visitation->mediation_condition" :editable="false" />
                        </x-molecules.dd-dt>
                    @endif
                    <x-molecules.dd-dt label="希望条件">
                        <x-molecules.textarea-or-text name="desire_condition" :value="$visitation->desire_condition"
                            :editable="$visitation->canEditBeforeScheduleFix()" />
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
        <x-molecules.button-area>
            @if (request()->is('*create*'))
                <x-molecules.modal-button action="/visitation"
                    confirmText="面会が登録されると、すぐに{{ $nonResidentParentLabel }}に日程調整を依頼するメールが届きます。" />
            @endif
            @if ($visitation->isToBeScheduled() && Auth::user()->isResidentRole())
                <x-molecules.button-submit method="PUT" data-action="/visitation/{{ $visitation->uuid }}">
                    更新する
                </x-molecules.button-submit>
                <x-molecules.modal-button action="{{ route('visitation.destroy', $visitation->uuid) }}" method="DELETE"
                    validate="false" color="red" buttonName="削除する" confirmTitle="削除しますか？" confirmText="削除すると戻せません。" />
            @endif
        </x-molecules.button-area>
    </form>
@endsection
