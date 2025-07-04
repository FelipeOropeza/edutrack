<div class="bg-blue-50 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-blue-800 mb-6">Portal Escolar</h1>

        @if ($error)
            <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
                {{ $error }}
            </div>
        @endif

        <div class="max-w-md mx-auto mt-20 p-6 bg-white rounded shadow">

            <form wire:submit="login" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email institucional</label>
                    <input type="email" id="email" wire:model.blur="email" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" id="password" wire:model.blur="password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                        Entrar
                    </button>
                </div>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                &copy; {{ date('Y') }} Escola Modelo. Todos os direitos reservados.
            </p>
        </div>

    </div>
</div>