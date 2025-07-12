<div class="max-w-5xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Faltas dos Filhos</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="font-semibold">Selecionar Aluno:</label>
            <select wire:model.live="alunoSelecionado" class="w-full border rounded p-2">
                @foreach ($alunos as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
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

    @if ($faltasPorDisciplina->isEmpty())
        <p class="text-gray-500">Nenhuma falta registrada para este bimestre.</p>
    @else
        @foreach ($faltasPorDisciplina as $disciplina => $faltas)
            @php
                $total = $faltas->count();
                $presentes = $faltas->where('presente', true)->count();
                $faltasCount = $total - $presentes;
                $percentual = $total > 0 ? round(($presentes / $total) * 100, 1) : 0;
            @endphp

            <div class="mb-2 text-sm text-gray-700">
                <p><strong>Total de aulas:</strong> {{ $total }}</p>
                <p><strong>Total de faltas:</strong> {{ $faltasCount }}</p>
                <p><strong>Presença:</strong> {{ $percentual }}%</p>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ $disciplina }}</h3>
                <table class="w-full table-auto border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border text-left">Data</th>
                            <th class="p-2 border text-center">Presença</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faltas as $falta)
                            <tr>
                                <td class="p-2 border">{{ \Carbon\Carbon::parse($falta->diaLetivo->data)->format('d/m/Y') }}</td>
                                <td class="p-2 border text-center">
                                    @if ($falta->presente)
                                        <span class="text-green-700">✔️ Presente</span>
                                    @else
                                        <span class="text-red-700">❌ Falta</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>