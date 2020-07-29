<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MagazineHomeController extends Controller
{
    public function show(Request $request)
    {
        dd($request->headers->all());

        return response()->json([]);
    }
}
