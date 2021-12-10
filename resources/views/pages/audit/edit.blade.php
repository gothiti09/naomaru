@extends('layouts.app')
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="監査登録" />
    <form action="" name="form" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <x-molecules.icon-description title="監査登録とは何ですか？"
            description='以下に回答をいただくと弊社が監査作業を実施します。第三者が監査を実施することによって、提案先企業様により信頼されやすくなります。'>
            <x-atoms.svg-question size="xl" viewBox="24" />
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

        <div class="flex flex-col items-center">
            <x-molecules.button-area>
                <x-molecules.button-submit method="POST" data-action="{{ route('audit.store') }}">
                    監査登録する
                </x-molecules.button-submit>
            </x-molecules.button-area>
        </div>
    </form>
@endsection
