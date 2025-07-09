<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckUserRole;

use App\Livewire\Login;
use App\Livewire\ListarAluno;
use App\Livewire\ListarProfessor;
use App\Livewire\AssociarAluno;
use App\Livewire\CadastroTurma;
use App\Livewire\CadastroProfessor;
use App\Livewire\CadastroResponsavel;
use App\Livewire\CadastroDisciplina;

use App\Livewire\DiretoriaDashboard;

use App\Livewire\ProfessorDashboard;
use App\Livewire\LancarNotas;

// Página de login
Route::get('/login', Login::class)->name('login');

// Logout (com POST)
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// -----------------------------
// Rotas da DIRETORIA
// -----------------------------
Route::middleware([
    'auth',
    CheckUserRole::class . ':diretoria',
])->group(function () {
    Route::get('/dashboard', DiretoriaDashboard::class)->name('dashboard');
    Route::get('/cadastrar-professor', CadastroProfessor::class)->name('cadastro.professor');
    Route::get('/cadastrar-responsavel', CadastroResponsavel::class)->name('cadastro.responsavel');
    Route::get('/cadastrar-turma', CadastroTurma::class)->name('cadastro.turma');
    Route::get('/cadastrar-disciplina', CadastroDisciplina::class)->name('cadastro.disciplina');
    Route::get('/professor/{id}/turmas', ListarProfessor::class)->name('professor.turmas');
    Route::get('/listar-alunos', ListarAluno::class)->name('listar.alunos');
    Route::get('/associar-aluno', AssociarAluno::class)->name('associar.aluno');
});

// -----------------------------
// Rotas do PROFESSOR
// -----------------------------
Route::middleware([
    'auth',
    CheckUserRole::class . ':professor',
])->group(function () {
    Route::get('/professor/dashboard', ProfessorDashboard::class)->name('professor.dashboard');
    Route::get('/professor/lancar-notas', LancarNotas::class)->name('professor.lancar-notas');
});

// -----------------------------
// Rotas do RESPONSÁVEL
// -----------------------------
// Route::middleware([
//     'auth',
//     CheckUserRole::class . ':responsavel',
// ])->group(function () {
//     Route::get('/responsavel/dashboard', ResponsavelDashboard::class)->name('responsavel.dashboard');
// });
