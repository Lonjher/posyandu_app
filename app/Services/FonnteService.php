<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class FonnteService
{
    public function sendMessage($phone, $message, $delay = '')
    {
        return Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
                    'target' => $phone,   // contoh: 628123456789
                    'message' => $message,
                    'delay' => $delay
                ])->json();
    }
}
