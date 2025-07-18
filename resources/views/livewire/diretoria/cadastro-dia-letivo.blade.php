<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Cadastro de Dias Letivos</h2>

    @if (session()->has('sucesso'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('sucesso') }}
        </div>
    @endif

    <form wire:submit.prevent="salvar" class="space-y-4">
        <div>
            <label class="block font-semibold">Data</label>
            <input type="date" wire:model="data" class="w-full border rounded p-2">
            @error('data') <span x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Bimestre</label>
            <select wire:model="bimestre" class="w-full border rounded p-2">
                <option value="">Selecione</option>
                <option value="1">1º Bimestre</option>
                <option value="2">2º Bimestre</option>
                <option value="3">3º Bimestre</option>
                <option value="4">4º Bimestre</option>
            </select>
            @error('bimestre') <span x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Descrição (opcional)</label>
            <input type="text" wire:model="descricao" class="w-full border rounded p-2">
            @error('descricao') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
    </form>

    <hr class="my-6">

    <h3 class="text-xl font-semibold mb-2">Dias Cadastrados</h3>

    <ul class="space-y-2">
        @foreach ($diasLetivos as $dia)
            <li class="flex justify-between items-center border p-2 rounded">
                <div>
                    <strong>{{ \Carbon\Carbon::parse($dia->data)->format('d/m/Y') }}</strong> -
                    {{ $dia->bimestre }}º bimestre
                    @if($dia->descricao)
                        - {{ $dia->descricao }}
                    @endif
                </div>
                <button wire:click="deletar({{ $dia->id }})" class="text-red-600 hover:underline text-sm">Excluir</button>
            </li>
        @endforeach
    </ul>
</div>