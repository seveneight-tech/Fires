<div class="center jumbotron">
    <div class="text-center">
        <h1 style="font-size: 3rem;">Welcome to the Fires</h1>
        <a href="{{ route('register') }}">
            <x-primary-button class="btn-lg">
                ユーザ登録はこちら！
            </x-primary-button>
        </a>
    </div>
    <div class="text-center">
        <a href="{{ route('login') }}" class="underline">
            既に登録済みの方はこちら
        </a>
    </div>
</div>