
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*********************** RUTAS PARA LAS SUSCRIPCIONES ***********************/

// Ruta para guardar la suscripción push
Route::post('/push/subscribe', [App\Http\Controllers\PushSubscriptionController::class, 'store']);

// Ruta para enviar notificaciones push
Route::post('/push/send', [App\Http\Controllers\PushNotificationController::class, 'send']);

/*********************** RUTAS PARA LAS SUSCRIPCIONES ***********************/

// Endpoint de login para API usando Sanctum
Route::post('/login', function (Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    // Generar token de acceso personal con Sanctum
    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
});
