<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Postcode;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UploadDocumentController;

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

Route::post('/member', [MemberController::class, 'store']);
Route::put('/member/{id}', [MemberController::class, 'update']);
Route::put('/upd-member-status/{id}', [MemberController::class, 'update_status']);
// Route::delete('/member/{id}', [MemberController::class, 'destroy']);

Route::post('/upload-document', UploadDocumentController::class);

Route::get('/postcodes', function () {
    $postcodes = Postcode::orderBy('province')->get();
    return response()->json($postcodes);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
