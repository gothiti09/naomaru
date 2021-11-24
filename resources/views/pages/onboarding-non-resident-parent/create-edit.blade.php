@extends('layouts.app')
@php
$label = Auth::user()->nonResidentParentLabel();
@endphp
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="{{ $label }}設定" />
    @if (!Auth::user()->family->set_non_resident_parent_at)
        <div class="space-y-4"
            x-data="{lists: [{id: 'mail', name: 'メールで招待'}, {id: 'doc', name: '書面で招待'}], type: 'mail'}">
            <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $label }}の招待方法
                    </h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <x-molecules.dd-dt label="{{ $label }}の招待方法" required=true>
                            <template x-for="list in lists" :key="list.id">
                                <div>
                                    <input x-model="type" type="radio" :value="list.id.toString()" :id="list.name"
                                        class="focus:ring-primary-500 h-4 w-4 text-primary-500 border-gray-300">
                                    <label :for="list.name" x-text="list.name"></label>
                                </div>
                            </template>
                        </x-molecules.dd-dt>
                    </dl>
                </div>
            </div>
            <div x-show="type=='mail'">
                <x-molecules.icon-description title="メールで招待" description="{{ $label }}のメールアドレスがわかる場合、招待メールを送信できます。">
                    <x-atoms.svg-question size="xl" viewBox="24" />
                </x-molecules.icon-description>
                <form action="" name="form" method="POST">
                    @csrf
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
                                    <p class="text-gray-500 text-xs">{{ $label }}がログイン以降閲覧できなくなります。</p>
                                </x-molecules.dd-dt>
                            </dl>
                        </div>
                    </div>

                    <x-molecules.button-area>
                        @if ($user->exists)
                            <x-molecules.modal-button
                                action="{{ route('onboarding-non-resident-parent.resend', $user->id) }}" method="PUT"
                                confirmTitle="招待メールを再送しますか？" buttonName="招待メールを再送する"
                                confirmText="招待メールを再送すると、{{ $label }}に招待メールが届きます。" />
                            <x-atoms.button-outline class="submit" size="xl"
                                data-action="{{ route('onboarding-non-resident-parent.destroy', $user->id) }}"
                                data-method="DELETE" data-validate=false>
                                別のアドレスを招待する
                            </x-atoms.button-outline>
                        @else
                            <x-molecules.modal-button action="{{ route('onboarding-non-resident-parent.store') }}"
                                confirmTitle="招待しますか？" buttonName="招待する"
                                confirmText="招待すると、{{ $label }}に招待メールが届きます。" />
                        @endif
                    </x-molecules.button-area>
                </form>
            </div>
            <div x-show="type=='doc'">
                <form action="" name="form" method="POST">
                    @csrf
                    <x-molecules.icon-description title="書面で招待"
                        description='{{ $label }}のメールアドレスがわからない（知りたくない）場合、以下からダウンロードして、{{ $label }}にお渡しください。<br>その場合は、{{ $label }}がログインして設定が完了するまでお待ち下さい。<br><a href="/onboarding-non-resident-parent/download" target="_blank" class="underline text-primary text-primary-500 hover:text-primary-900">書面ダウンロード'>
                        <x-atoms.svg-question size="xl" viewBox="24" />
                    </x-molecules.icon-description>
                    <div class="flex justify-center">
                        <x-molecules.button-submit data-action="/onboarding-non-resident-parent/wait">
                            {{ $label }}のログインを待つ
                        </x-molecules.button-submit>
                    </div>
                </form>

            </div>
        </div>
    @else
        <p class="text-gray-500 text-xs">{{ $label }}がログインして初期設定が完了しました。</p>
    @endif
@endsection
