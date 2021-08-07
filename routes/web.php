<?php

// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Models\Postcode;

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

Route::get('/test', function () {
    // echo uniqid();
    // V4ITTTBoaSlnTYj9xXpoApUgXCNtDlCPPAtioMuA.png
    echo '<img src="' . asset('storage/uploads/jDzFFWJV45zSdG5t6zIDFkTUk8AMUyNbjwiC3gGD.png') . '"/>';
});

// Route::get('/gen-passwd', function () {
//     echo Hash::make('P@ssw0rd!');
// });

Route::get('/register-form', function () {
    return view('register-form',[
        'postcodes' => Postcode::orderBy('province')->get(),
    ]);
});

// Route::get('/', [App\Http\Controllers\SearchController::class, 'index']);
Route::get('/', function() {
    return view('home',[]);
});
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index']);
Route::post('/search', [App\Http\Controllers\SearchController::class, 'index']);
Route::get('/receipt/{id}', [App\Http\Controllers\ReceiptController::class, 'show']);
Route::get('/contract/{id}', App\Http\Controllers\ContractController::class);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::delete('/member/{id}/delete', [MemberController::class, 'destroy'])->name('member.delete');
});

// Route::resource('member', App\Http\Controllers\MemberController::class);

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
