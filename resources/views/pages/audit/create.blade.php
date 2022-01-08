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
        @foreach ($audit_item_groups as $audit_item_group)
            <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $audit_item_group->title }}
                    </h3>

                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        @foreach ($audit_item_group->auditItems as $audit_item)
                            <dl class="sm:divide-y sm:divide-gray-200">
                                <x-molecules.dd-dt label="{{ $audit_item->title }}" cols=2>
                                    <div class="space-y-5">
                                        <div class="relative flex items-center space-x-3">
                                            @if ($audit_item->checkbox)
                                                <x-atoms.radio name="audit_item_group_answers[{{ $audit_item_group->id }}][audit_item_answers][{{ $audit_item->id }}][answer_check]"
                                                    :option="['0' => 'いいえ', '1' => 'はい']" checked="" />
                                            @endif
                                            @if ($audit_item->text)
                                                <x-atoms.textarea name="audit_item_group_answers[{{ $audit_item_group->id }}][audit_item_answers][{{ $audit_item->id }}][answer_text]"
                                                    :value="$request_audit->description ?? $audit_item->template" rows=4 />
                                            @endif
                                            @if ($audit_item->evidence)
                                                <div class="mt-2">
                                                    <x-atoms.input-file id="file" name="audit_item_group_answers[{{ $audit_item_group->id }}][audit_item_answers][{{ $audit_item->id }}][answer_file]" />
                                                </div>
                                            @endif
                                        </div>
                                </x-molecules.dd-dt>
                            </dl>
                        @endforeach
                    </div>
                </div>
            </div>
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
