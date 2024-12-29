<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowFeatureTest extends TestCase
{
    use RefreshDatabase; // テスト後にデータベースをリセット

    /**
     * @test
     */
    public function a_user_can_follow_another_user()
    {
        // Arrange: テストデータを用意
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        // Act: ログインしてフォローを実行
        $response = $this->actingAs($user)
                         ->post(route('follow.store', $otherUser));

        // Assert: ステータスとフォロー状態を確認
        $response->assertStatus(302); // リダイレクトを確認
        $this->assertTrue($user->following->contains($otherUser)); // フォロー関係が作成されているか確認
    }

    /**
     * @test
     */
    public function a_user_can_unfollow_another_user()
    {
        // Arrange
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $user->following()->attach($otherUser->id); // 事前にフォロー状態にする

        // Act: フォロー解除を実行
        $response = $this->actingAs($user)
                         ->delete(route('follow.destroy', $otherUser));

        // Assert
        $response->assertStatus(302);
        $this->assertFalse($user->following->contains($otherUser)); // フォロー関係が削除されているか確認
    }

    /**
     * @test
     */
    public function a_user_cannot_follow_the_same_user_twice()
    {
        // Arrange
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        // Act: 同じユーザーを2回フォローしようとする
        $this->actingAs($user)->post(route('follow.store', $otherUser));
        $this->actingAs($user)->post(route('follow.store', $otherUser));

        // Assert
        $this->assertEquals(1, $user->following()->where('followed_id', $otherUser->id)->count());
    }

    /**
     * @test
     */
    public function a_user_cannot_follow_themself()
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)
                         ->post(route('follow.store', $user));

        // Assert
        $response->assertStatus(403); // 自己フォローは403エラーを期待
        $this->assertFalse($user->following->contains($user));
    }
}
