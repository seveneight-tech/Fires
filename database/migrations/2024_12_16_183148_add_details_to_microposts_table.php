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
        Schema::table('microposts', function (Blueprint $table) {
            $table->dateTime('practice_date')->nullable(); // 練習日時
            $table->float('distance')->nullable(); // 走行距離
            $table->float('pace')->nullable(); // ペース
            $table->float('time')->nullable(); // 時間
            $table->integer('heart_rate_level')->nullable(); // 心拍レベル
            $table->string('sport_type')->nullable(); // スポーツのタイプ
        });
    }
    
    public function down()
    {
        Schema::table('microposts', function (Blueprint $table) {
            $table->dropColumn(['practice_date', 'distance', 'pace', 'time', 'heart_rate_level', 'sport_type']);
        });
    }
};
