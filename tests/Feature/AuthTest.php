<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Hash;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    public function test_mail_is_required()
    {
        $response = $this->postJson(route('api.login'));

        $response->assertStatus(422)->assertJsonValidationErrors('email');
    }

    public function test_password_is_required()
    {
        $response = $this->postJson(route('api.login'));

        $response->assertStatus(422)->assertJsonValidationErrors('password');
    }

    public function test_email_not_exists()
    {
        $response = $this->postJson(route('api.login'), ['email' => $this->faker->email]);

        $response->assertStatus(422)->assertJsonValidationErrors('email');
    }

    public function test_incorrect_password()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('api.login'), ['email' => $user->email, 'password' => $this->faker->password]);

        $response->assertStatus(422)->assertJsonValidationErrors('password');
    }

    public function test_successful_login()
    {
        $email = $this->faker->email;
        $password = $this->faker->password;

        User::factory()->create(['email' => $email, 'password' => Hash::make($password)]);

        $response = $this->postJson(route('api.login'), ['email' => $email, 'password' => $password]);

        $response->assertStatus(200)->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    public function test_get_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->get(route('api.user'));

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['id', 'name', 'email', 'email_verified_at', 'created_at', 'updated_at'])
            ->assertSee($user->email);
    }
}
