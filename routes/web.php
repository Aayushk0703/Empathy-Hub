<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CalendarEventController;

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
    return redirect('/app');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:Admin,Staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('media', MediaController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
    Route::resource('products', ProductController::class);
    Route::resource('calendar', CalendarEventController::class)->parameters(['calendar' => 'calendarEvent']);
});

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('payments', PaymentController::class);
});

Route::post('/admin/session-login', [AuthController::class, 'adminSessionLogin'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'webLogout'])->name('logout.get');

Route::get('/app/{any?}', function () {
    $path = public_path('app/index.html');

    abort_unless(file_exists($path), 404, 'Frontend build not found. Run the frontend build first.');

    return response()->file($path);
})->where('any', '^(?!admin(?:/|$)|api(?:/|$)).*');
