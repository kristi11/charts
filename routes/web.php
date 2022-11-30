<?php

use App\Models\Chart;
use App\Models\User;
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

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/', function () {
    return view('charts');
});

Route::get('/stats', function () {
    $revenue = Chart::where('created_at', '>=' , now()->subDays(30))->sum('total');
    return view('stats', [
        'revenue' => $revenue,
    ]);
});
