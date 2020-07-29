<?php

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    dd(request()->headers->get('User'));

    return view('welcome');
});


Route::domain('auth.mplus.test')->get('login', function () {
    $authKey = Http::post('http://auth/login', [
        'email' => 'selmonal@gmail.com',
        'password' => '123123123'
    ])->throw()->json()['auth_key'];

    return response('Hello world')->cookie(
        'auth_key', $authKey, 120, '/', '.mplus.test'
    );
});
