<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Registrar Faltas</h2>

    @if (session()->has('sucesso'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div>
            <label class="block font-semibold mb-1">Data</label>
            <select wire:model.live="dia_letivo_id" class="w-full border rounded p-2">
                <option value="">Selecione</option>
                @foreach ($diasLetivos as $dia)
                    <option value="{{ $dia->id }}">
                        {{ \Carbon\Carbon::parse($dia->data)->format('d/m/Y') }} - {{ $dia->bimestre }}º Bim.
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Turma</label>
            <select wire:model.live="turma_id" class="w-full border rounded p-2">
                <option value="">Selecione</option>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Disciplina</label>
            <select wire:model.live="disciplina_id" class="w-full border rounded p-2">
                <option value="">Selecione</option>
                @foreach ($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id }}">{{ $disciplina->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($alunos)
        <form wire:submit.prevent="salvar" class="space-y-4">
            <table class="w-full text-left border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">Aluno</th>
                        <th class="p-2">Presente?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $alunoTurma)
                        <tr class="border-t">
                            <td class="p-2">{{ $alunoTurma->aluno->nome }}</td>
                            <td class="p-2">
                                <input type="checkbox" wire:model="presencas.{{ $alunoTurma->id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Salvar Presenças
            </button>
        </form>
    @endif
</div>
