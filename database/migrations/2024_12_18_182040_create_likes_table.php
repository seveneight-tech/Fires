<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // いいねをしたユーザー
            $table->foreignId('micropost_id')->constrained()->onDelete('cascade'); // いいね対象の投稿
            $table->timestamps();
    
            $table->unique(['user_id', 'micropost_id']); // ユーザーが同じ投稿に重複していいねできない
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
