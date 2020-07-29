<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

$router->get('/middlewares/app-api', function (Request $request) {
    // Device-Auth header is requried.
    if (! $request->headers->has('Device-Auth')) {
        return response('Invalid device auth.', 403);
    }

    try {
        $deviceData = JWT::decode(
            $request->headers->get('Device-Auth'),
            config('app.key'),
            ['HS256']
        );
    } catch (SignatureInvalidException $exceptiohn) {
        return response('Invalid device auth.', 403);
    }

    return response('', 200, [
        'Correlation-Id' => (string) Str::uuid(),
        'Device-Id' => $deviceData->id,
    ]);
});

$router->post('/jwt/encode', function (Request $request) {
    $token = JWT::encode($request->all(), config('app.key'));

    return response()->json(compact('token'));
});
