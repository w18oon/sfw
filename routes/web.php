<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Models\Postcode;

Route::get('/register-form', function () {
    return view('register-form',[
        'postcodes' => Postcode::orderBy('province')->get(),
    ]);
});

Route::get('/', function() {
    return view('home',[]);
    // echo resource_path();
});
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index']);
Route::post('/search', [App\Http\Controllers\SearchController::class, 'index']);
Route::get('/receipt/{id}', [App\Http\Controllers\ReceiptController::class, 'show']);
Route::get('/contract/{id}', App\Http\Controllers\ContractController::class);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/{id}', [MemberController::class, 'show'])->name('member.show');
    Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::delete('/member/{id}/delete', [MemberController::class, 'destroy'])->name('member.delete');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
