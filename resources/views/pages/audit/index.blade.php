@extends('layouts.app')
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="監査登録" />
    <x-molecules.icon-description title="監査登録とは何ですか？"
        description='以下に回答をいただくと弊社が監査作業を実施します。第三者が監査を実施することによって、提案先企業様により信頼されやすくなります。'>
        <x-atoms.svg-question size="xl" viewBox="24" />
    </x-molecules.icon-description>


    <div class="flex flex-col items-center">
        <x-molecules.button-area>
            @if ($latest_audit)
                <x-atoms.button-primary onclick="location.href='{{ route('audit.show', $latest_audit->uuid) }}'">
                    最新の監査結果を確認する
                </x-atoms.button-primary>
            @endif
            <x-atoms.button-primary onclick="location.href='{{ route('audit.create') }}'">
                新しく監査登録をする
            </x-atoms.button-primary>
        </x-molecules.button-area>
    </div>
@endsection
