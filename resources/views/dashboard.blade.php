<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 mt-10 leading-tight">
            {{ __('About') }}<span class="block text-sm">このサイトについて</span>
        </h2>
    </x-slot>
    <section class="w-10/12 m-auto mt-10">
        <h2 class="text-black font-bold text-5xl">Welcom to <span class="text-6xl"style="font-family:'Alata','sans-serif';">Gathering code</span>!!!</h2>
        <p class="text-black text-lg mt-10">Gathering code、略してGa-code(ゲコード)はフロントエンド開発者向けのコードコレクションサイトです。学習の記録、教材やtips集の作成、新しい発見のためなど様々な用途でお使いいただけます。</p>
    </section>
    {{--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>--}}
</x-app-layout>
@extends('common/footer')
