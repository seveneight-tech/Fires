<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = [
        'content', 
        'user_id',
        'practice_date', 
        'distance', 
        'pace', 
        'time', 
        'heart_rate_level', 
        'sport_type'
    ];
    
    /**
     * この投稿を所有するユーザ。（Userモデル)との関係を定義
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * この投稿をいいねするユーザを把握
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
