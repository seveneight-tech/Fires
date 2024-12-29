<?php

namespace App\Http\Controllers;

use App\Models\Micropost;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Micropost $micropost)
    {
        // すでにいいねしていない場合のみ作成
        if (!$micropost->likes()->where('user_id', Auth::id())->exists()) {
            $micropost->likes()->create(['user_id' => Auth::id()]);
        }

        return back();
    }

    public function destroy(Micropost $micropost)
    {
        // いいねを取り消す
        $micropost->likes()->where('user_id', Auth::id())->delete();

        return back();
    }
}