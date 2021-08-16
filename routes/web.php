<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Models\Postcode;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/php-info', function() {
    phpinfo();
});

Route::get('/register-form', function () {
    return view('register-form',[
        'postcodes' => Postcode::orderBy('province')->get(),
    ]);
});

Route::get('/', function() {
    return view('home',[]);
});
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index']);
Route::post('/search', [App\Http\Controllers\SearchController::class, 'index']);
Route::get('/receipt/{id}', [App\Http\Controllers\ReceiptController::class, 'show']);
Route::get('/contract/{id}', App\Http\Controllers\ContractController::class);

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/{id}', [MemberController::class, 'show'])->name('member.show');
    Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::delete('/member/{id}/delete', [MemberController::class, 'destroy'])->name('member.delete');
    Route::get('/report', [ReportController::class, 'index']);
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
