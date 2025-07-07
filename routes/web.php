<?php

use App\Livewire\CadastroDisciplina;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\CadastroProfessor;
use App\Livewire\CadastroResponsavel;
use App\Livewire\CadastroTurma;
use App\Livewire\DiretoriaDashboard;
use App\Livewire\ListarAluno;
use App\Livewire\ListarProfessor;
use App\Livewire\Login;

Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DiretoriaDashboard::class)->name('dashboard');
    Route::get('/cadastrar-professor', CadastroProfessor::class)->name('cadastro.professor');
    Route::get('/cadastrar-responsavel', CadastroResponsavel::class)->name('cadastro.responsavel');
    Route::get('/cadastrar-turma', CadastroTurma::class)->name('cadastro.turma');
    Route::get('/cadastrar-disciplina', CadastroDisciplina::class)->name('cadastro.disciplina');
    Route::get('/professor/{id}/turmas', ListarProfessor::class)->name('professor.turmas');
    Route::get('/listar-alunos', ListarAluno::class)->name('listar.alunos');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
