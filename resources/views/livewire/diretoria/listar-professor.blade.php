<div class="max-w-4xl mx-auto mt-8 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Professor: {{ $professor->user->name }}</h2>
    <p class="text-gray-600 mb-6">Email: {{ $professor->user->email }}</p>

    <h3 class="text-xl font-semibold mb-4">Turmas e Disciplinas</h3>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-left">Turma</th>
                <th class="border px-4 py-2 text-left">Ano Letivo</th>
                <th class="border px-4 py-2 text-left">Disciplina</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professor->vinculos as $vinculo)
                <tr>
                    <td class="border px-4 py-2">{{ $vinculo->turma->nome }}</td>
                    <td class="border px-4 py-2">{{ $vinculo->turma->ano_letivo }}</td>
                    <td class="border px-4 py-2">{{ $vinculo->disciplina->nome }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
