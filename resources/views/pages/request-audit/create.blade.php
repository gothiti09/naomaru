@extends('layouts.app')
@php
const DESCRIPTION = <<<EOT
【対象企業】
XXX

【業務概要】
XXX
EOT;
@endphp
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="監査代行" />
    <form action="" name="form" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <x-molecules.icon-description title="監査代行とは何ですか？"
            description='お客さまが関連会社・購買先・外部委託先などに対して行う二者監査を、金属加工における受発注プロフェッショナルである弊社がお客さまに代わって実施します。'>
            <x-atoms.svg-question size="xl" viewBox="24" />
        </x-molecules.icon-description>
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    監査代行したい案件概要
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="依頼したいプラン" required=true>
                        <fieldset>
                            <legend class="sr-only">Plan</legend>
                            <div class="space-y-5">
                                <div class="relative flex items-start">
                                    <x-atoms.radio name="plan"
                                        :option="['松プラン' => '松プラン', '梅プラン' => '梅プラン', '竹プラン' => '竹プラン']" checked=""
                                        required=true />
                                </div>
                        </fieldset>

                    </x-molecules.dd-dt>
                </dl>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="監査代行したい案件概要" required=true>
                        <x-atoms.textarea name="description" :value="$request_audit->description ?? DESCRIPTION" rows=8 />
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
        <div class="flex flex-col items-center">
            <x-molecules.button-area>
                <x-molecules.button-submit method="POST" data-action="{{ route('request-audit.store') }}">
                    監査代行を依頼する
                </x-molecules.button-submit>
            </x-molecules.button-area>
        </div>
    </form>
@endsection
