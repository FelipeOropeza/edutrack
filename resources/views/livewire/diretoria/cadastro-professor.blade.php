<div>
    <div class="max-w-6xl mx-auto mt-8 flex gap-8 items-start">
        <section class="w-1/3 bg-white p-6 rounded shadow flex flex-col">
            <h2 class="text-2xl font-bold mb-6">Cadastrar Professor</h2>

            <form wire:submit.prevent="cadastrar" class="space-y-4 flex-grow">
                <input type="text" wire:model.defer="nome" placeholder="Nome"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('nome')
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                        x-transition.opacity.duration.300ms class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror

                <input type="email" wire:model.defer="email" placeholder="Email"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('email')
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                        x-transition.opacity.duration.300ms class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror

                <input type="password" wire:model.defer="password" placeholder="Senha"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('password')
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                        x-transition.opacity.duration.300ms class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 rounded w-full font-semibold transition">Cadastrar</button>

                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2400)" x-show="show"
                        x-transition:leave="transition-opacity ease-in duration-500" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <p x-show="show" class="mt-4 text-green-600 font-medium">{{ session('message') }}</p>
                    </div>
                @endif
            </form>
        </section>

        <section class="w-2/3 bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-6">Buscar Professores</h2>

            <input type="text" wire:model.live="search" placeholder="Buscar por nome ou email..."
                class="w-full mb-4 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />

            <ul class="space-y-3 max-h-[400px] overflow-y-auto">
                @forelse ($professores as $prof)
                    <li class="border rounded p-4 flex items-center justify-between hover:shadow-sm transition">
                        <div>
                            <p class="font-semibold text-lg">{{ $prof->user->name }}</p>
                            <p class="text-gray-600 text-sm">{{ $prof->user->email }}</p>
                            <p class="text-gray-500 text-xs uppercase tracking-wider">{{ $prof->user->role }}</p>
                        </div>

                        <div class="flex gap-2">
                            <button wire:click="abrirModalVincular({{ $prof->id }})"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold text-sm transition"
                                title="Vincular este professor a uma turma">
                                Vincular à Turma
                            </button>

                            <a href="{{ route('professor.turmas', $prof->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold text-sm transition"
                                title="Ver turmas e disciplinas do professor">
                                Visualizar
                            </a>
                        </div>
                    </li>
                @empty
                    <li class="text-gray-500">Nenhum professor encontrado.</li>
                @endforelse
            </ul>

        </section>

    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <div x-data="{ open: @entangle('modalAberto') }" x-show="open" x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg w-96 max-w-full">
            <h3 class="text-xl font-semibold mb-4">Vincular Professor</h3>

            <select wire:model="turma_id" class="w-full border rounded px-3 py-2 mb-4">
                <option value="">-- Selecione a turma --</option>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}">{{ $turma->nome }} ({{ $turma->ano_letivo }})</option>
                @endforeach
            </select>
            @error('turma_id')
                <p x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
                    class="text-red-600 text-sm mb-4">{{ $message }}</p>
            @enderror

            <select wire:model="disciplina_id" class="w-full border rounded px-3 py-2 mb-4">
                <option value="">-- Selecione a disciplina --</option>
                @foreach ($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id }}">{{ $disciplina->nome }}</option>
                @endforeach
            </select>
            @error('disciplina_id')
                <p x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
                    class="text-red-600 text-sm mb-4">{{ $message }}</p>
            @enderror

            <div class="flex justify-end gap-4">
                <button @click="open = false"
                    class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">Cancelar</button>
                <button wire:click="vincularTurmaDisciplina"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">
                    Confirmar
                </button>
            </div>
        </div>
    </div>

</div>