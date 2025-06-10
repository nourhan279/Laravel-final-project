<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_email_format()
    {
        $response = $this->from('/English_form')->post('/register', [
            'full_name' => 'noura',
            'user_name' => 'nnoura',
            'email' => 'not-an-email', //wrongformat
            'phone' => '0123456789',
            'whatsapp' => '0123456789',
            'password' => 'nouraP@ss1',
            'confirm_password' => 'nouraP@ss1',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_all_fields_required()
    {
        $response = $this->from('/English_form')->post('/register', []);

        $response->assertSessionHasErrors([
            'full_name',
            'user_name',
            'email',
            'phone',
            'whatsapp',
            'password',
            'confirm_password',
        ]);
    }

}
