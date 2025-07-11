<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Lançamento de Notas</h2>

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

    @if ($this->alunos->count())
        <table class="w-full border border-gray-300 table-auto rounded overflow-hidden">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">Aluno</th>
                    <th class="p-2 border text-center">Avaliação 1</th>
                    <th class="p-2 border text-center">Avaliação 2</th>
                    <th class="p-2 border text-center">Avaliação 3</th>
                    <th class="p-2 border text-center">Média</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alunos as $aluno)
                    @php
                        $avaliacoes = $notas[$aluno->id] ?? [];
                        $media = $this->calcularMedia($avaliacoes);
                        $status = $this->statusMedia($media);
                    @endphp
                    <tr>
                        <td class="p-2 border">{{ $aluno->nome }}</td>

                        @for($i = 1; $i <= 3; $i++)
                            <td class="p-2 border text-center">
                                <input type="number" step="0.1" min="0" max="10" wire:model.defer="notas.{{ $aluno->id }}.{{ $i }}"
                                    class="w-full border rounded p-1 text-center">
                            </td>
                        @endfor

                        <td class="p-2 border text-center font-semibold {{ $status['cor'] }}">
                            {{ $status['icone'] }} {{ number_format($media, 1) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <button wire:click="salvarNotas"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded transition">
                Salvar Notas
            </button>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="mt-4 bg-green-100 text-green-800 p-3 rounded shadow">
            {{ session('message') }}
        </div>
    @endif
</div>