<?php

use App\Livewire\CadastroProfessor;
use App\Livewire\DiretoriaDashboard;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DiretoriaDashboard::class)->name('dashboard');
    Route::get('/cadastrar-professor', CadastroProfessor::class)->name('cadastro.professor');
});

Route::post('/logout', function () {
    Auth::logout();;
    return redirect('/login');
})->name('logout');
