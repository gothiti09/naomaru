@extends('layouts.app')
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="ユーザー情報・会社情報登録" />
    <form action="" name="form" method="POST" class="space-y-4">
        @csrf
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    会社
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="法人番号" required=true>
                        <x-atoms.input name="company[corporate_number]" :value="$company->corporate_number" required=true />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="会社名" required=true>
                        <x-atoms.input name="company[name]" :value="$company->name" required=true />
                    </x-molecules.dd-dt>

                </dl>
            </div>
        </div>
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    部署・チーム
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="ユーザーID" required=true>
                        <x-atoms.input name="login_id" :value="$user->login_id" required=true />
                        <p class="text-gray-500 text-xs">部署名英字など。半角英数字6文字以上</p>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="パスワード">
                        <x-atoms.input name="password" type="password" />
                        <p class="text-gray-500 text-xs">半角英数字8文字以上</p>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="パスワード（確認）">
                        <x-atoms.input name="confirmed" type="password" />
                        <p class="text-gray-500 text-xs">確認のためパスワードを再入力してください。</p>
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="部署名・チーム名" required=true>
                        <x-atoms.input name="team_name" :value="$user->team_name" required=true />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="所在地" required=true>
                        <x-atoms.select name="prefecture_code" :option="$prefectures->pluck('name', 'code')"
                            selected="{{ $user->prefecture_code ?? '' }}" placeholder="選択してください" required=true />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="自己紹介">
                        <x-atoms.textarea name="description" :value="$user->description"
                            placeholder="自社の特徴や強みなどをご記入ください。" />
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    アカウント管理者
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <x-molecules.dd-dt label="メールアドレス">
                        <x-atoms.input name="email" :value="$user->email" type="email" />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="名前" required=true>
                        <x-atoms.input name="name" :value="$user->name" required=true />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="名前フリガナ" required=true>
                        <x-atoms.input name="kana" :value="$user->kana" required=true />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="電話番号" required=true>
                        <x-atoms.input name="tel" :value="$user->tel" type="tel" required=true />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="性別" required=true>
                        <x-atoms.select name="sex" :option="['1' => '男性', '2' => '女性', '9' => 'その他']"
                            selected="{{ $user->sex }}" placeholder="選択してください" required=true />
                    </x-molecules.dd-dt>
                    <x-molecules.dd-dt label="年代" required=true>
                        <x-atoms.select name="age_range"
                            :option="['10' => '10代', '20' => '20代', '30' => '30代', '40' => '40代', '50' => '50代', '60' => '60代', ]"
                            selected="{{ $user->age_range }}" placeholder="選択してください" required=true />
                    </x-molecules.dd-dt>
                </dl>
            </div>
        </div>
        <x-molecules.button-area>
            <x-molecules.button-submit method="PUT" data-action="{{ route('user.update', $user->uuid) }}">
                設定する
            </x-molecules.button-submit>
        </x-molecules.button-area>
    </form>
@endsection
