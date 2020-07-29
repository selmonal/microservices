<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Mail\SimpleMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

$router->post('send/simple', function (Request $request) {
    Mail::to($request->get('to'))->send(new SimpleMail($request));

    return response()->json([
        'message' => 'Sent'
    ]);
});
