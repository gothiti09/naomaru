@extends('layouts.app')
@section('content')
    <x-molecules.breadcrumbs :links="[]" />
    <x-organisms.page-header title="" />
    <form action="" name="form" method="POST" class="space-y-4">
        @csrf
        <div class="bg-white shadow overflow-hidden rounded-lg mb-4">
            <div class="border-gray-200 px-4 py-5 sm:p-0">
            </div>
        </div>
    </form>
@endsection
