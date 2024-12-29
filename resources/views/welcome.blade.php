<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Welcome to the Fires!') }}
            </h2>
            <a href="{{ route('microposts.create') }}" 
                class="px-4 py-2 bg-white text-black font-semibold border border-gray-300 rounded hover:bg-gray-100">
                {{ __('投稿') }}
            </a>
        </div>
    </x-slot>
    @if (Auth::check())
        <div class="row">
            {{-- 認証済みユーザのカードを表示 --}}
            <div class="container">
                <div class="row" style="display: flex; justify-content: center;">
                    @foreach($all_users as $user)
                        <x-user-card :user="$user"/>
                    @endforeach
                </div>
            </div>
         </div>
        {{-- 投稿セクション --}}
        <x-microposts :microposts="$microposts" />
        <x-micropost-form 
            :action="route('microposts.store')" 
            placeholder="Share your thoughts..." 
            buttonText="Post"
        />
    @else
        {{-- 認証されていない場合の Welcome バナー --}}
        <x-welcome-banner/>
    @endif
</x-app-layout>