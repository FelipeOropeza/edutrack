<?php

use App\Livewire\CadastroAluno;
use Illuminate\Support\Facades\Route;

use App\Livewire\Login;
use App\Livewire\ProfessorDashboard;
use Illuminate\Support\Facades\Auth;

Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', ProfessorDashboard::class)->name('dashboard');
    Route::get('/cadastrar-aluno', CadastroAluno::class)->name('cadastro.aluno');
});

Route::post('/logout', function () {
    Auth::logout();;
    return redirect('/login');
})->name('logout');
