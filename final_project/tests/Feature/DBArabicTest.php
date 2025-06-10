<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DBArabicTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test */

   public function user_sees_success_message_after_registering_in_arabic()
   {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('avatar.jpg');

    $response = $this->withSession(['locale' => 'ar'])->post('/register', [
        'full_name' => 'مستخدم تجريبي',
        'user_name' => 'arabictestuser',
        'country' => 'مصر',
        'city' => 'القاهرة',
        'email' => 'arabictest@example.com',
        'phone' => '+20123456789',
        'whatsapp' => '+20123456789',
        'password' => 'Passw0rd!',
        'password_confirmation' => 'Passw0rd!',
        'file' => $file,
    ]);

    $response->assertSessionHas('success', 'تم التسجيل بنجاح!');
    $this->assertDatabaseHas('laravel_users', [
        'email' => 'arabictest@example.com',
    ]);
  }
}