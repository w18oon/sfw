<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Postcode;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/member', [App\Http\Controllers\MemberController::class, 'store']);
Route::put('/member/{id}', [App\Http\Controllers\MemberController::class, 'update']);

Route::get('/postcodes', function () {
    $postcodes = Postcode::orderBy('province')->get();
    return response()->json($postcodes);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
