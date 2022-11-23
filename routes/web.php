<?php

use App\Models\Chart;
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
    return view('welcome');
});

Route::get('/charts', function () {
    $lastYearChart = Chart::query()
        ->whereYear('created_at', date('Y') - 1)
        ->groupByMonth();

    $thisYearChart = Chart::query()
        ->whereYear('created_at', date('Y'))
        ->groupByMonth();

//dd($thisYearChart);
    return view('charts',[
        'thisYearChart' => $thisYearChart,
        'lastYearChart' => $lastYearChart
    ]);
});
