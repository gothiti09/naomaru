@extends('layouts.app')
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="緊急連絡" />
    <form action="" name="form" method="POST" class="space-y-4">
        @csrf
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="border-gray-200 px-4 py-5 sm:p-0">
                @if ($message->message)
                    <div class="flex items-center pt-4 sm:pt-5 sm:px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <p class="ml-2 text-base text-gray-900 font-medium">
                            {{ $message->messageBy()->first()->roleLabel() }}
                        </p>
                        <p class="ml-4 text-xs text-gray-900 font-medium">
                            {{ $message->created_at?->isoFormat('M月D日(ddd) H:mm') }}
                        </p>
                    </div>
                    <p class="mx-8 mt-3 mb-6 text-sm text-gray-900 font-medium">
                        {!! nl2br(e($message->message))  !!}
                    </p>
                @endif
                @if ($message->reply)
                    <div class="flex items-center pt-4 sm:pt-5 sm:px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <p class="ml-2 text-base text-gray-900 font-medium">
                            {{ $message->replyBy()->first()->roleLabel() }}
                        </p>
                        <p class="ml-4 text-xs text-gray-900 font-medium">
                            {{ $message->updated_at?->isoFormat('M月D日(ddd) H:mm') }}
                        </p>
                    </div>
                    <p class="mx-8 mt-3 mb-6 text-sm text-gray-900 font-medium">
                        {!! nl2br(e($message->reply))  !!}
                    </p>
                @endif
                <dl class="sm:divide-y sm:divide-gray-200">
                    @if (request()->is('*create*'))
                        <x-molecules.dd-dt label="連絡（140文字まで）">
                            <x-atoms.textarea name="message" :value="$message->message" required maxlength="140" rows="6" />
                        </x-molecules.dd-dt>
                    @endif
                    @if (request()->is('*edit*') && !$message->reply)
                        <x-molecules.dd-dt label="返信（140文字まで）">
                            <x-atoms.textarea name="reply" :value="$message->reply" required maxlength="140" rows="6" />
                        </x-molecules.dd-dt>
                    @endif
                </dl>
                <x-molecules.button-area>
                    @if (request()->is('*create*'))
                        <x-molecules.modal-button action="{{ route('message.store') }}" confirmTitle="緊急連絡しますか？"
                            buttonName="緊急連絡する" confirmText="緊急連絡すると、すぐに相手にメールが届きます。" />
                    @elseif( request()->is('*edit*') && !$message->reply)
                        <x-molecules.modal-button action="{{ route('message.update', $message->uuid) }}" method="PUT"
                            confirmTitle="返信しますか？" buttonName="返信する" confirmText="返信すると、すぐに相手にメールが届きます。" />
                    @else
                        <x-atoms.button-primary onclick="location.href='{{ route('message.index') }}'">
                            緊急連絡一覧に戻る
                        </x-atoms.button-primary>
                    @endif
                </x-molecules.button-area>
            </div>
        </div>
    </form>
@endsection
