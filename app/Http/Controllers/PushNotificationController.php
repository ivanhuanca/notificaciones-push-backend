<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class PushNotificationController extends Controller
{
    // Envía una notificación al usuario especificado
    public function send(Request $request, $user_id)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $subscriptions = DB::table('push_subscriptions')->where('user_id', $user_id)->get();

        $auth = [
            'VAPID' => [
                'subject' => env('VAPID_SUBJECT'),
                'publicKey' => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
            ],
        ];

        $webPush = new WebPush($auth);

        foreach ($subscriptions as $sub) {
            $subscription = Subscription::create([
                'endpoint' => $sub->endpoint,
                'publicKey' => $sub->public_key,
                'authToken' => $sub->auth_token,
                'contentEncoding' => $sub->content_encoding ?? 'aesgcm',
            ]);

            $payload = json_encode([
                'title' => $request->title,
                'body' => $request->body,
            ]);

            $webPush->queueNotification($subscription, $payload);
        }

        $response = $webPush->flush();

        /* Procesar los resultados de las notificaciones */
        $results = [];
        foreach ($response as $report) {
            $results[] = [
                'endpoint' => $report->getRequest()->getUri()->__toString(),
                'success' => $report->isSuccess(),
                'message' => $report->getReason() ?: 'Enviado',
            ];
        }
        return response()->json(['message' => 'Notificaciones enviadas', 'success' => $results]);
    }
}
