@extends('layouts.app')
@section('content')
    <x-molecules.icon-description title="緊急連絡とは？"
        description='相手にメールで通知します。<br>どうしても連絡が必要な場合にのみご利用ください。<br>用件のみ簡潔に記述してください。'>
        <x-atoms.svg-question size="xl" viewBox="24" />
    </x-molecules.icon-description>
    <x-organisms.page-header title="緊急連絡" create="{{ Auth::user()->read_message ? '/message/create' : '' }}" />
    @if ($messages?->count())
        @foreach ($messages as $message)
            <div class="mb-4 bg-white shadow overflow-hidden rounded-md">
                <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center">
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
                    <p class="ml-8 mt-3 text-sm text-gray-900 font-medium">
                        {!! nl2br(e($message->message))  !!}
                    </p>
                    @if ($message->reply)
                        <div class="mt-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
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
                        <p class="ml-8 mt-3 text-sm text-gray-900 font-medium">
                            {!! nl2br(e($message->reply))  !!}
                        </p>
                        <button onclick="location.href='{{ route('message.edit', $message->uuid) }}'"
                            class="mt-4 inline-flex items-center px-2 py-1 text-xs border border-primary-500 shadow-sm font-medium rounded-full text-primary-500 bg-white hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            閲覧する
                        </button>
                    @else
                        <button onclick="location.href='{{ route('message.edit', $message->uuid) }}'"
                            class="mt-4 inline-flex items-center px-2 py-1 text-xs border border-primary-500 shadow-sm font-medium rounded-full text-primary-500 bg-white hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            返信する
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p class="text-gray-500 text-sm text-center">緊急連絡はまだ登録されていません。</p>
    @endif
@endsection
