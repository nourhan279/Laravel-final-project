<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DBTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

     /** @test */
   /** @test */
    public function test_user_sees_success_message_after_registering()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->withSession(['locale' => 'en'])->post('/register', [
            'full_name' => 'Test User',
            'user_name' => 'testuser123',
            'country' => 'USA',
            'city' => 'New York',
            'email' => 'testuser@example.com',
            'phone' => '+1234567890',
            'whatsapp' => '+1234567890',
            'password' => 'Passw0rd!',
            'password_confirmation' => 'Passw0rd!',
            'file' => $file,
        ]);

        $response->assertRedirect(); // optional

        // ✅ Assert the success message is in the session flash
        $response->assertSessionHas('success', 'User registered successfully!');

        // ✅ Also ensure the user is stored in DB
        $this->assertDatabaseHas('laravel_users', [
            'email' => 'testuser@example.com',
        ]);
    }
}
