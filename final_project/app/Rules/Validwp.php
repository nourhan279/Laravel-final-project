<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Validwp implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if result is cached
        $cacheKey = 'validated_whatsapp_' . md5($value);

        if (Cache::has($cacheKey)) {
            $isValid = Cache::get($cacheKey);
        } else {
            // Call API
            $response = Http::withHeaders([
                'x-rapidapi-key' => '72b05b35a8msha4db4f59d8a7cd2p1fcadfjsn600ea600b86f',
                'x-rapidapi-host' => 'whatsapp-number-validator3.p.rapidapi.com',
                'Content-Type' => 'application/json',
            ])->post('https://whatsapp-number-validator3.p.rapidapi.com/WhatsappNumberHasItWithToken', [
                'phone_number' => $value,
            ]);

            $isValid = $response->successful() && $response->json('status') === 'valid';

            // Store the result in cache for 24 hours
            Cache::put($cacheKey, $isValid, now()->addHours(24));
        }

        if (!$isValid) {
            $fail('The :attribute is not a valid WhatsApp number.');
        }
    }
}
