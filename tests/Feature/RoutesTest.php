<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_when_no_locale()
    {
        $url = route('articles.index');

        $response = $this->get($url);

        $response->assertStatus(302);
    }

    public function test_main_catalog_page(): void
    {
        $url = route('articles.index', ['locale' => 'ru']);

        $response = $this->get($url);

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
    }

    public function test_profile_page_no_auth(): void
    {
        $url = route('profile.index', ['locale' => 'ru']);

        $response = $this->get($url);

        $response->assertStatus(302);
    }

    public function test_profile_page_auth(): void
    {
        $user = User::query()->create([
            'name' => 'user1',
            'email' => 'user1@user1.com',
            'password' => '123123123',
            'phone' => '123123123123',
            'is_verified' => false
        ]);

        $url = route('profile.index', ['locale' => 'ru']);
        $response = $this->actingAs($user)->get($url);

        $response->assertOk();
    }
}
