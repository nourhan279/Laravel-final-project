<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Rules\Validwp;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Validator;

class WhatsAppValidationTest extends TestCase
{

    public function test_passes_with_valid_whatsapp_number()
    {
        Http::fake([
            'https://whatsapp-number-validator3.p.rapidapi.com/*' => Http::response([
                'status' => 'valid'
            ], 200),
        ]);

        $rule = new Validwp();

        $data = ['whatsapp' => '+1234567890'];
        $validator = Validator::make($data, [
            'whatsapp' => [$rule],
        ]);

        $this->assertTrue($validator->passes());
    }


    public function test_fails_with_invalid_whatsapp_number()
    {
        Http::fake([
            'https://whatsapp-number-validator3.p.rapidapi.com/*' => Http::response([
                'status' => 'invalid'
          ], 200),
        ]);

        $rule = new Validwp();

        $data = ['whatsapp' => '+0000000000'];
        $validator = Validator::make($data, [
            'whatsapp' => [$rule],
        ]);

        $this->assertFalse($validator->passes());
        $this->assertEquals(
              'The whatsapp is not a valid WhatsApp number.',
            $validator->errors()->first('whatsapp')
        );
    }
}
