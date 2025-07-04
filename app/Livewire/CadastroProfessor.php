<?php

namespace App\Livewire;

use App\Models\Professor;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class CadastroProfessor extends Component
{
    public string $nome = '';
    public string $email = '';
    public string $password = '';
    public $search = '';

    public function cadastrar()
    {
        $this->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        
        $user = User::create([
            'name' => $this->nome,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'professor',
        ]);

        Professor::create([
            'user_id' => $user->id,
        ]);

        session()->flash('message', 'Professor cadastrado com sucesso.');
        $this->reset(['nome', 'email', 'password']);
    }
    public function render()
    {
        $professores = Professor::with('user')
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.cadastro-professor', compact('professores'));
    }
}
