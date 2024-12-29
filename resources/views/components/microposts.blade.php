@if (count($microposts) > 0)
    <ul class="list unstyled">
        @foreach($microposts as $micropost)
            <li class="media mb-3">
                <img class="mr-2 rounded" src="{{ Gravatar::get($micropost->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        <a href="{{ route('users.show', ['user' => $micropost->user->id]) }}">
                            {{ $micropost->user->name }}
                        </a>
                        <li class="list-group-item">
                            <p>{{ $micropost->content }}</p>
                            <p>練習日時: {{ $micropost->practice_date }}</p>
                            <p>走行距離: {{ $micropost->distance }} km</p>
                            <p>ペース: {{ $micropost->pace }} min/km</p>
                            <p>時間: {{ $micropost->time }} 時間</p>
                            <p>心拍レベル: {{ $micropost->heart_rate_level }}</p>
                            <p>スポーツのタイプ: {{ $micropost->sport_type }}</p>
                                                    <!-- いいねボタン -->
                            @if ($micropost->likes->contains('user_id', Auth::id()))
                                <form action="{{ route('like.destroy', $micropost) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">
                                        <i class="fas fa-heart"></i> <!-- Filled heart -->
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('like.store', $micropost) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-red-500">
                                        <i class="far fa-heart"></i> <!-- Empty heart -->
                                    </button>
                                </form>
                            @endif
                            <span>{{ $micropost->likes->count() }}</span>
                            <br>
                            <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                        </li>
                    </div>
                    <div>
                    {{-- 投稿削除ボタンのフォーム --}}
                        @if (Auth::id() === $micropost->user_id)
                            <form action="{{ route('microposts.destroy', $micropost->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">削除</button>
                            </form>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $microposts->links() }}
@endif