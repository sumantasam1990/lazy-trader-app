<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return to_route('register');
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
});

Route::get('terms', function () {
   return Inertia::render('TermsOfService');
})->name('terms.show');

Route::get('policy', function () {
    return Inertia::render('PrivacyPolicy');
})->name('policy.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/support/tickets', [\App\Http\Controllers\TicketController::class, 'index'])->name('support.ticket');
    Route::get('/support/ticket/create', [\App\Http\Controllers\TicketController::class, 'create'])->name('support.ticket.create');
    Route::post('/support/ticket/create/store', [\App\Http\Controllers\TicketController::class, 'store'])->name('support.ticket.store');

    Route::get('ticket/message/{id}', [\App\Http\Controllers\MessageController::class, 'index'])->name('support.ticket.message');

    Route::post('/ticket/message/store', [\App\Http\Controllers\MessageController::class, 'store'])->name('support.message.store');

    Route::get('/page/create', [\App\Http\Controllers\PageController::class, 'create'])->name('page.create');
});

Route::get('fake', function () {
   return \App\Models\TicketMessage::query()->with(['parent', 'child'])
       ->where('ticket_id', 1)
       ->get();
});
