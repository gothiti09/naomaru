<x-molecules.menu-link href="/" label="ホーム" :select="request()->is('/')">
    <x-atoms.svg-home viewBox="24" class="text-gray-300" />
</x-molecules.menu-link>
<x-molecules.menu-link href="{{route('project.index')}}" label="募集一覧" :select="request()->is('*project*')">
    <x-atoms.svg-list viewBox="24" class="text-gray-300" />
</x-molecules.menu-link>
<x-molecules.menu-link href="{{route('request-audit.create')}}" label="監査代行" :select="request()->is('request-audit*')">
    <x-atoms.svg-user viewBox="24" class="text-gray-300" />
</x-molecules.menu-link>
<x-molecules.menu-link href="{{route('project.index')}}" label="監査登録" :select="request()->is('audit*')">
    <x-atoms.svg-document viewBox="24" class="text-gray-300" />
</x-molecules.menu-link>
<x-molecules.menu-link href="" target="_blank" label="お問い合わせ">
    <x-atoms.svg-question viewBox="24" class="text-gray-300" />
</x-molecules.menu-link>
