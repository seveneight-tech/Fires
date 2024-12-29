<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">Microposts</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    {{-- ユーザ一覧へのリンク --}}
                    <li class="nav-link">
                        <a href="{{ route('users.index') }}" class="nav-link">ユーザ一覧</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            {{-- ユーザ詳細ページへのリンク --}}
                            <li>
                                <a href="{{ route('users.show', ['user' => Auth::id()]) }}">プロフィール</a>
                            </li>
                            <li class="dropdown-divider"></li>
                            {{-- ログアウトへのリンク --}}
                            <li class="dropdown-item">
                                <form method="POST" action="{{ route('logout.post') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-link">ログアウト</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li>
                        <a href="{{ route('register') }}" class="nav-link">ユーザ登録はこちら！</a>
                    </li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">ログインはこちら！</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
