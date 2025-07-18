<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-6">
    <h2 class="text-2xl font-bold mb-6">Cadastro de Responsável</h2>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Nome</label>
        <input type="text" wire:model="nome" class="w-full border rounded px-3 py-2" />
        @error('nome') <span x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
        class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Email</label>
        <input type="email" wire:model="email" class="w-full border rounded px-3 py-2" />
        @error('email') <span x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
        class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <p class="text-gray-600 mb-6 text-sm">A senha padrão será o próprio email informado.</p>

    <button wire:click="$set('modalAberto', true)"
        class="mb-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Adicionar Aluno
    </button>

    <div class="mb-6">
        <h3 class="font-semibold mb-2">Alunos vinculados:</h3>

        @if (count($alunos) > 0)
            <ul class="space-y-2">
                @foreach ($alunos as $aluno)
                    <li class="border px-4 py-2 rounded bg-gray-100">
                        <strong>{{ $aluno['nome'] }}</strong> - {{ $aluno['data_nascimento'] }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Nenhum aluno adicionado ainda.</p>
        @endif
    </div>

    <button wire:click="salvarResponsavel" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
        Salvar Responsável
    </button>

    @if ($modalAberto)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-xl w-96 relative">
                <h3 class="text-lg font-bold mb-4">Adicionar Aluno</h3>

                <div class="mb-3">
                    <label class="block font-medium mb-1">Nome do Aluno</label>
                    <input type="text" wire:model="nomeAluno" class="w-full border rounded px-3 py-2" />
                    @error('nomeAluno') <span x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)"
                    x-show="show" class="text-red-500 text-sm">{{ $errors->first('nomeAluno') }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Data de Nascimento</label>
                    <input type="date" wire:model="dataNascimentoAluno" class="w-full border rounded px-3 py-2" />
                    @error('dataNascimentoAluno') <span x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 2000)" x-show="show"
                    class="text-red-500 text-sm">{{ $errors->first('dataNascimentoAluno') }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('modalAberto', false)" class="px-4 py-2 rounded bg-gray-300">Cancelar</button>
                    <button wire:click="adicionarAluno" class="px-4 py-2 rounded bg-blue-600 text-white">Adicionar</button>
                </div>
            </div>
        </div>
    @endif
</div>