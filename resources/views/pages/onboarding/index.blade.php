@extends('layouts.app')
@php
$residentParentLabel = Auth::user()->residentParentLabel();
$nonResidentParentLabel = Auth::user()->nonResidentParentLabel();
@endphp
@section('content')

    @if ($family->set_resident_parent_at && !$family->set_non_resident_parent_at && $family->inviting_non_resident_parent_at && $family->set_visitation_at)
        <x-molecules.icon-description title="お疲れさまでした！"
            description='必須設定が全て完了しました！<br>{{ $nonResidentParentLabel }}がアカウント設定するまでお待ち下さい。'>
            <x-atoms.svg-cake size="xl" viewBox="24" />
        </x-molecules.icon-description>
    @elseif ($family->set_resident_parent_at && $family->set_non_resident_parent_at && $family->set_visitation_at)
        <x-molecules.icon-description title="おめでとうございます！" description='すべての準備が整いました！<br>以下のボタンからさっそく使ってみましょう。'>
            <x-atoms.svg-cake size="xl" viewBox="24" />
        </x-molecules.icon-description>
        <form action="" name="form" method="POST">
            <x-molecules.button-area>
                @csrf
                <x-molecules.button-submit data-action="/onboarding">使ってみる</x-molecules.button-submit>
            </x-molecules.button-area>
        </form>
    @else
        <x-molecules.icon-description title="はじめまして！らえるへようこそ！"
            description='らえるは同居親と別居親が連絡先を交換することなく、面会交流の調整ができて、第三者も確認できる面会交流支援サービスです。<br>はじめにサービスを使うための基本情報を設定してください。設定は後から変更できます。'>
            <x-atoms.svg-cake size="xl" viewBox="24" />
        </x-molecules.icon-description>
    @endif
    <x-organisms.page-header title="基本情報" />
    <div class="bg-white shadow overflow-hidden rounded-md">
        <div class="p-4">
            <nav aria-label="Progress">
                <ol role="list" class="overflow-hidden">
                    <x-molecules.step :isComplete="$family->set_visitation_at" :isUpcoming="!$family->set_visitation_at"
                        href="/setting-visitation" title="ステップ１　面会交流設定" description="面会交流の情報を設定してください。" :required="true" />
                    <x-molecules.step :isComplete="$family->set_resident_parent_at"
                        :isUpcoming="!$family->set_resident_parent_at" href="/setting-resident-parent" :required="true"
                        title="ステップ２　{{ $residentParentLabel }}設定"
                        description="{{ $residentParentLabel }}（こどもと同居中の親）の情報を設定してください。" />
                    <x-molecules.step :isComplete="$family->inviting_non_resident_parent_at"
                        :isUpcoming="!$family->inviting_non_resident_parent_at" href="/onboarding-non-resident-parent"
                        title="ステップ３　{{ $nonResidentParentLabel }}設定"
                        description="{{ $nonResidentParentLabel }}（こどもと別居中の親）の情報を設定してください。" :required="true" />
                    <x-molecules.step :isComplete="$family->set_resident_agent_at"
                        :isUpcoming="!$family->set_resident_agent_at" href="/setting-resident-agent"
                        title="{{ 'ステップ４　' . Auth::user()->residentAgentLabel() . '設定' }}"
                        description="{{ Auth::user()->residentAgentLabel() . 'の情報を設定してください。' }}" :haveNext="false" />
                </ol>
            </nav>
        </div>
    </div>
@endsection
