<div class="max-w-6xl mx-auto mt-8 flex gap-8">

    <section class="w-1/3 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Cadastrar Disciplina</h2>

        <form wire:submit.prevent="cadastrar" class="space-y-4">
            <input type="text" wire:model.defer="nome" placeholder="Nome da Disciplina (ex: Matemática)"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('nome')
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                    x-transition.opacity.duration.300ms class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </div>
            @enderror

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white py-2 rounded w-full font-semibold transition">Cadastrar</button>

            @if (session()->has('message'))
                <p class="mt-4 text-green-600 font-medium">{{ session('message') }}</p>
            @endif
        </form>
    </section>

    <section class="w-2/3 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Disciplinas Cadastradas</h2>

        <input type="text" wire:model.live="search" placeholder="Buscar por nome..."
            class="w-full mb-4 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <ul class="space-y-3 max-h-[400px] overflow-auto">
            @forelse ($disciplinas as $disciplina)
                <li class="border-b border-gray-300 py-2 flex justify-between">
                    <div>
                        <span class="font-semibold">{{ $disciplina->nome }}</span>
                    </div>
                </li>
            @empty
                <li class="text-gray-500">Nenhuma disciplina encontrada.</li>
            @endforelse
        </ul>
    </section>

</div>
