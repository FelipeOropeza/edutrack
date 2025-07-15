<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Notas dos Filhos</h2>

    <!-- Seleção de Bimestre -->
    <div class="mb-4">
        <label class="font-semibold">Selecionar Bimestre:</label>
        <select wire:model.live="bimestre" class="border rounded p-2 ml-2">
            <option value="1">1º Bimestre</option>
            <option value="2">2º Bimestre</option>
            <option value="3">3º Bimestre</option>
            <option value="4">4º Bimestre</option>
        </select>
    </div>

    <!-- Exibindo os Filhos -->
    @forelse($filhosComNotas as $aluno)
        <div class="mb-6 border rounded p-4 shadow">
            <!-- Nome do Aluno e Botão de Imprimir -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold">{{ $aluno->nome }}</h3>
                <a href="{{ route('responsavel.index', $aluno->id) }}" 
                   class="ml-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                   Imprimir Boletim
                </a>
            </div>

            @php
                $avaliacoesFiltradas = $aluno->avaliacoes
                    ->where('bimestre', $bimestre)
                    ->groupBy(fn($a) => $a->disciplina->nome ?? 'Sem Disciplina');
            @endphp

            <!-- Tabela de Avaliações -->
            @if ($avaliacoesFiltradas->count())
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Disciplina</th>
                            <th class="border p-2">Avaliação 1</th>
                            <th class="border p-2">Avaliação 2</th>
                            <th class="border p-2">Avaliação 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($avaliacoesFiltradas as $disciplina => $avaliacoes)
                            <tr>
                                <td class="border p-2 font-semibold">{{ $disciplina }}</td>
                                @for ($i = 1; $i <= 3; $i++)
                                    @php
                                        $nota = $avaliacoes->firstWhere('numero', $i)?->nota ?? '-';
                                    @endphp
                                    <td class="border p-2 text-center">{{ $nota }}</td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Nenhuma nota lançada para o {{ $bimestre }}º bimestre.</p>
            @endif
        </div>
    @empty
        <p class="text-gray-500">Você não tem filhos cadastrados no sistema.</p>
    @endforelse
</div>
