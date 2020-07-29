<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InitController extends Controller
{
    public function init(Request $request)
    {
        // Generate device auth token.
        $deviceAuthToken = Http::retry(3, 100)
            ->post('http://auth/jwt/encode', [ 'id' => 51610 ])
            ->throw()
            ->json()['token'];

        return response()->json([
            'device_auth' => $deviceAuthToken
        ]);
    }
}
