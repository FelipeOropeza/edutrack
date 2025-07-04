<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Login;
use App\Livewire\ProfessorDashboard;

Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', ProfessorDashboard::class)->name('dashboard');
});

// Route::post('/logout', function () {
//     auth()->logout();
//     return redirect('/login');
// })->name('logout');
