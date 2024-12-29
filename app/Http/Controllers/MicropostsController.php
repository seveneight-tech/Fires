<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micropost;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if(\Auth::check()){
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        return view('dashboard', $data);
    }

    public function create()
    {
        return view('microposts.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'practice_date' => 'nullable|date',
            'distance' => 'nullable|numeric',
            'pace' => 'nullable|numeric',
            'time' => 'nullable|numeric',
            'heart_rate_level' => 'nullable|integer',
            'sport_type' => 'nullable|string|max:255',
        ]);

        $micropost = new Micropost([
            'content' => $validated['content'],
            'practice_date' => $validated['practice_date'],
            'distance' => $validated['distance'],
            'pace' => $validated['pace'],
            'time' => $validated['time'],
            'heart_rate_level' => $validated['heart_rate_level'],
            'sport_type' => $validated['sport_type'],
            'user_id' => auth()->id(),
        ]);
        $micropost->save();

        return redirect()->route('microposts.index');
    }
    
    public function destroy($id)
    {
        $micropost = Micropost::findOrFail($id);
        
        if(\Auth::id() === $micropost->user_id){
            $micropost->delete();
        }
        
        return back();
    }

    public function edit($id)
    {
        // 投稿を取得
        $micropost = Micropost::findOrFail($id);

        // 権限チェック
        if (auth()->id() !== $micropost->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // 編集フォームにデータを渡す
        return view('microposts.edit', compact('micropost'));
    }

    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|string|max:255',
            'practice_date' => 'nullable|date',
            'distance' => 'nullable|numeric|min:0',
            'pace' => 'nullable|string|max:10',
            'time' => 'nullable|string|max:10',
            'heart_rate_level' => 'nullable|integer|min:0|max:300',
            'sport_type' => 'nullable|string|max:50',
        ]);

        // 投稿を取得
        $micropost = Micropost::findOrFail($id);

        // 権限チェック
        if (auth()->id() !== $micropost->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // 投稿を更新
        $micropost->update($request->only([
            'content',
            'practice_date',
            'distance',
            'pace',
            'time',
            'heart_rate_level',
            'sport_type',
        ]));

        // 更新完了後、リダイレクト
        return redirect()->route('dashboard')->with('success', '投稿が更新されました。');
    }
}
