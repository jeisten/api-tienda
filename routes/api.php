<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PropietarioController;
use App\Http\Controllers\Api\TiendaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rutas de autenticación públicas
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    
    // Rutas protegidas de autenticación
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});

// Rutas protegidas por autenticación
Route::middleware('auth:sanctum')->group(function () {
    
    // Rutas de Propietarios
    Route::apiResource('propietarios', PropietarioController::class);
    
    // Rutas de Tiendas
    Route::apiResource('tiendas', TiendaController::class);
    
    // Rutas adicionales
    Route::get('propietarios/{propietario}/tiendas', function($propietario) {
        return \App\Http\Resources\TiendaResource::collection(
            \App\Models\Propietario::findOrFail($propietario)->tiendas
        );
    });
    
});

// Ruta de prueba
Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando correctamente',
        'timestamp' => now(),
        'version' => '1.0.0'
    ]);
});

// Ruta para obtener información de la API
Route::get('/info', function () {
    return response()->json([
        'name' => 'API Control de Permisos para Tiendas',
        'version' => '1.0.0',
        'description' => 'API REST para el control de permisos de suelos para tiendas',
        'endpoints' => [
            'auth' => [
                'POST /api/auth/login',
                'POST /api/auth/register',
                'POST /api/auth/logout',
                'GET /api/auth/user'
            ],
            'propietarios' => [
                'GET /api/propietarios',
                'POST /api/propietarios',
                'GET /api/propietarios/{id}',
                'PUT /api/propietarios/{id}',
                'DELETE /api/propietarios/{id}'
            ],
            'tiendas' => [
                'GET /api/tiendas',
                'POST /api/tiendas',
                'GET /api/tiendas/{id}',
                'PUT /api/tiendas/{id}',
                'DELETE /api/tiendas/{id}'
            ]
        ]
    ]);
});
