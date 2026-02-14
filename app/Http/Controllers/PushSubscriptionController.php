<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PushSubscriptionController extends Controller
{
    // Guarda la suscripción enviada desde el frontend
    public function store(Request $request)
    {
        $data = $request->validate([
            'endpoint' => 'required|string',
            'keys.auth' => 'required|string',
            'keys.p256dh' => 'required|string',
            'user_id' => 'nullable|integer',
        ]);

        // Guardar la suscripción en la base de datos
        DB::table('push_subscriptions')->updateOrInsert(
            ['endpoint' => $data['endpoint']],
            [
                'user_id' => $data['user_id'] ?? null,
                'public_key' => $data['keys']['p256dh'],
                'auth_token' => $data['keys']['auth'],
                'content_encoding' => 'aesgcm',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json(['message' => 'Suscripción guardada']);
    }
}
