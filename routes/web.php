<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
Auth::routes();

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('qr/{uuid}', function($uuid)
{
    return $uuid;
})->name('qr');

Route::get('qr-g/{uuid}', function ($uuid) {

    $qr = QrCode::size(500)
        ->generate(route('qr', $uuid));

    return view('qrCode', compact('qr'));
});
