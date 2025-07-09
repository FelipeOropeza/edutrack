<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckUserRole;

use App\Livewire\Login;

use App\Livewire\Diretoria\ListarAluno;
use App\Livewire\Diretoria\ListarProfessor;
use App\Livewire\Diretoria\AssociarAluno;
use App\Livewire\Diretoria\CadastroTurma;
use App\Livewire\Diretoria\CadastroProfessor;
use App\Livewire\Diretoria\CadastroResponsavel;
use App\Livewire\Diretoria\CadastroDisciplina;
use App\Livewire\Diretoria\DiretoriaDashboard;

use App\Livewire\Professor\ProfessorDashboard;
use App\Livewire\Professor\LancarNotas;

use App\Livewire\Responsavel\ResponsavelDashboard;

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
    Route::get('/diretoria/dashboard', DiretoriaDashboard::class)->name('diretoria.dashboard');
    Route::get('/diretoria/cadastrar-professor', CadastroProfessor::class)->name('cadastro.professor');
    Route::get('/diretoria/cadastrar-responsavel', CadastroResponsavel::class)->name('cadastro.responsavel');
    Route::get('/diretoria/cadastrar-turma', CadastroTurma::class)->name('cadastro.turma');
    Route::get('/diretoria/cadastrar-disciplina', CadastroDisciplina::class)->name('cadastro.disciplina');
    Route::get('/diretoria/professor/{id}/turmas', ListarProfessor::class)->name('professor.turmas');
    Route::get('/diretoria/listar-alunos', ListarAluno::class)->name('listar.alunos');
    Route::get('/diretoria/associar-aluno', AssociarAluno::class)->name('associar.aluno');
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
Route::middleware([
    'auth',
    CheckUserRole::class . ':responsavel',
])->group(function () {
    Route::get('/responsavel/dashboard', ResponsavelDashboard::class)->name('responsavel.dashboard');
});
