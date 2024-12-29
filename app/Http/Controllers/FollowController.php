<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller {
    public function store(User $user) {
        // フォロー処理
        // 重複フォロー、自己フォローを防ぐ処理
        if (!auth()->user()->following->contains($user->id) && auth()->id() !== $user->id) {
            auth()->user()->following()->attach($user->id);
        }
        return back();
    }

    public function destroy(User $user) {
        // フォロー解除処理
        auth()->user()->following()->detach($user->id);
        return back();
    }
}
