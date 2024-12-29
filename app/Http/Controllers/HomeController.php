<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Micropost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        // 投稿を取得（ログインユーザーの投稿を最新順で10件表示）
        $microposts = Micropost::with('user')->where('user_id', Auth::id())->latest()->paginate(10);

        // ビューにデータを渡してレンダリング
        return view('dashboard', compact('microposts'));
    }

    public function welcome()
    {
        // ペジネーション付きで投稿を取得
        $microposts = Micropost::latest()->paginate(10);
        $all_users = User::all();

        // ビューにデータを渡す
        return view('welcome', compact('microposts', 'all_users'));
    }
}