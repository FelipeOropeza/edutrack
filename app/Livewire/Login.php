<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $error = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();

            $user = Auth::user();

            return match ($user->role) {
                'diretoria' => redirect()->intended('/diretoria/dashboard'),
                'professor' => redirect()->intended('/professor/dashboard'),
                'responsavel' => redirect()->intended('/responsavel/dashboard'),
                default => redirect('/login'),
            };
        }

        $this->error = 'Email ou senha inválidos.';
    }

    public function render()
    {
        return view('livewire.login');
    }
}
