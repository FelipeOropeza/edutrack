<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Lançamento de Notas</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div>
            <label class="font-semibold">Turma:</label>
            <select wire:model.live="turma_id" class="w-full border rounded p-2">
                <option value="">Selecione...</option>
                @foreach($turmas as $turma)
                    <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold">Disciplina:</label>
            <select wire:model.live="disciplina_id" class="w-full border rounded p-2">
                <option value="">Selecione...</option>
                @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id }}">{{ $disciplina->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold">Bimestre:</label>
            <select wire:model.live="bimestre" class="w-full border rounded p-2">
                <option value="1">1º Bimestre</option>
                <option value="2">2º Bimestre</option>
                <option value="3">3º Bimestre</option>
                <option value="4">4º Bimestre</option>
            </select>
        </div>
    </div>
    @if ($this->alunos)
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Aluno</th>
                    <th class="p-2 border">Avaliação 1</th>
                    <th class="p-2 border">Avaliação 2</th>
                    <th class="p-2 border">Avaliação 3</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alunos as $aluno)
                    <tr>
                        <td class="p-2 border">{{ $aluno->nome }}</td>
                        @for($i = 1; $i <= 3; $i++)
                            <td class="p-2 border">
                                <input type="number" step="0.1" min="0" max="10" wire:model.defer="notas.{{ $aluno->id }}.{{ $i }}"
                                    class="w-full border rounded p-1">
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 text-right">
            <button wire:click="salvarNotas" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Salvar Notas
            </button>
        </div>
    @endif
</div>