<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-2xl font-bold mb-4">Associar Aluno à Turma</h2>

    <form wire:submit.prevent="associar">
        <div class="mb-4">
            <label for="aluno_id" class="block font-semibold">Aluno:</label>
            <select wire:model="aluno_id" class="w-full border rounded p-2">
                <option value="">Selecione...</option>
                @foreach ($alunos as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="turma_id" class="block font-semibold">Turma:</label>
            <select wire:model="turma_id" class="w-full border rounded p-2">
                <option value="">Selecione...</option>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}">{{ $turma->nome }} - {{ $turma->ano_letivo }}</option>
                @endforeach
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" type="submit">
            Associar e Criar Avaliações
        </button>
    </form>
</div>
