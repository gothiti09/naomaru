@extends('layouts.app')
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="監査登録" />
    <x-molecules.icon-description title="監査スコア">
        <x-atoms.svg-document size="xl" viewBox="24" />
        <x-slot name="description">
            <p>監査スコア<span class="text-3xl text-primary-500">{{$audit->point_avg}}</span>％（スコア合計<span class="text-xl text-primary-500">{{$audit->point_full}}</span>ポイント中、<span class="text-xl text-primary-500">{{$audit->point_sum}}</span>ポイント）　</p>
            <p>監査ランクは<span class="text-3xl text-primary-500">{{$audit->lank}}</span>です。
        </x-slot>
    </x-molecules.icon-description>
    @foreach ($audit->auditItemGroupAnswers as $audit_item_group_answer)
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $audit_item_group_answer->title }}
                </h3>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    @foreach ($audit_item_group_answer->auditItemAnswers as $audit_item_answer)
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <x-molecules.dd-dt label="{{ $audit_item_answer->title }}" cols=2>
                                <div class="space-y-5">
                                    <div class="relative flex items-center space-x-3">
                                        <div>
                                            @if ($audit_item_answer->checkbox)
                                                <x-atoms.text>
                                                    {{ $audit_item_answer->answer_check ? 'はい' : 'いいえ' }}
                                                </x-atoms.text>
                                            @endif
                                            @if ($audit_item_answer->evidence_name)
                                                <x-atoms.link
                                                    href="{{ route('audit.download', $audit_item_answer->uuid) }}">
                                                    {{ $audit_item_answer->evidence_name }}
                                                </x-atoms.link>
                                            @endif
                                        </div>
                                        @if ($audit_item_answer->text)
                                            <x-atoms.text>
                                                {{ $audit_item_answer->answer_text }}
                                            </x-atoms.text>
                                        @endif

                                    </div>
                            </x-molecules.dd-dt>
                        </dl>
                    @endforeach
                </div>
            </div>
        </div>
        @php
            $group_title = $audit_item_answer->group_title;
        @endphp
    @endforeach
@endsection
