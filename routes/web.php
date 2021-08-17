<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Models\Postcode;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

Route::get('/export-csv', function() {
    // echo date('Ymd_His');
    echo auth()->user()->name . date('_Ymd_His') . '.csv';
    // $headers = array(
    //     "Content-type" => "text/csv",
    //     "Content-Disposition" => "attachment; filename=test.csv",
    //     "Pragma" => "no-cache",
    //     "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
    //     "Expires" => "0"
    // );

    // // $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');

    // // $callback = function() use($tasks, $columns) {
    //     // $file = fopen('php://output', 'w');
    //     // fputcsv($file, $columns);

    //     // foreach ($tasks as $task) {
    //     //     $row['Title']  = $task->title;
    //     //     $row['Assign']    = $task->assign->name;
    //     //     $row['Description']    = $task->description;
    //     //     $row['Start Date']  = $task->start_at;
    //     //     $row['Due Date']  = $task->end_at;

    //     //     fputcsv($file, array($row['Title'], $row['Assign'], $row['Description'], $row['Start Date'], $row['Due Date']));
    //     // }

    //     // fclose($file);
    // // };
    // $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');
    // $file = fopen('storage/reports/aaa.csv', 'w');
    // fputcsv($file, $columns);
    // fclose($file);

    // return response()->stream(function() {
    //     $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');
    //     $file = fopen('php://output', 'w');
    //     // $file = fopen('php://output', 'w');
    //     fputcsv($file, $columns);
    //     fclose($file);
    // }, 200, $headers);
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
