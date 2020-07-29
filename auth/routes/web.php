<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

$router->get('/middlewares/app-api', function (Request $request) {
    // Device-Auth header is requried.
    if (! $request->headers->has('Device-Auth')) {
        return response('Invalid device auth.', 200);
    }

    try {
        $deviceData = JWT::decode(
            $request->headers->get('Device-Auth'),
            config('app.key'),
            ['HS256']
        );
    } catch (SignatureInvalidException $exceptiohn) {
        return response('Invalid device auth.', 200);
    }

    return response('', 200, [
        'Correlation-Id' => (string) Str::uuid(),
        'Device-Id' => $deviceData->id,
    ]);
});

$router->get('/middlewares/web', function (Request $request) {
    return response('', 200, [
        'Correlation-Id' => (string) Str::uuid(),
        'User' => Cache::get($request->cookie('auth_key')) ? json_encode(Cache::get($request->cookie('auth_key'))) : null
    ]);
});

$router->post('/jwt/encode', function (Request $request) {
    $token = JWT::encode($request->all(), config('app.key'));

    return response()->json(compact('token'));
});


$router->post('/login', function (Request $request) {
    $authKey = Str::random(32);

    Cache::remember($authKey, Carbon::now()->addHours(2), function () {
        return ['email' => 'selmonal@gmail.com'];
    });

    return response()->json([
        'auth_key' => $authKey
    ]);
});
