<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Lista de Alunos Cadastrados</h2>

    @if ($alunos->count())
        <table class="w-full text-left border border-gray-300 rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b">Nome</th>
                    <th class="py-2 px-4 border-b">Data de Nascimento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alunos as $aluno)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $aluno->nome }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">Nenhum aluno cadastrado ainda.</p>
    @endif
</div>
