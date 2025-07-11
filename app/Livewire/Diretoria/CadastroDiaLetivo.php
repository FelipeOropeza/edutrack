<?php

namespace App\Livewire\Diretoria;

use App\Models\DiaLetivo;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;

#[Layout('layouts.diretoria')]
class CadastroDiaLetivo extends Component
{
    public $data;
    public $bimestre;
    public $descricao;

    public function render()
    {
        $diasLetivos = DiaLetivo::orderBy('data')->get();

        return view('livewire.diretoria.cadastro-dia-letivo', compact('diasLetivos'));
    }

    public function salvar()
    {
        $this->validate([
            'data' => ['required', 'date', Rule::unique('dias_letivos', 'data')],
            'bimestre' => 'required|integer|between:1,4',
            'descricao' => 'nullable|string|max:255',
        ]);

        DiaLetivo::create([
            'data' => $this->data,
            'bimestre' => $this->bimestre,
            'descricao' => $this->descricao,
        ]);

        $this->reset(['data', 'bimestre', 'descricao']);

        session()->flash('sucesso', 'Dia letivo cadastrado com sucesso.');
    }

    public function deletar($id)
    {
        DiaLetivo::findOrFail($id)->delete();
        session()->flash('sucesso', 'Dia letivo excluído.');
    }
}