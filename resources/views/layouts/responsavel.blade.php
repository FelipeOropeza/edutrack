<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Dashboard do Responsável') | Portal Escolar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 min-h-screen flex">

    <aside class="w-58 bg-blue-800 text-white min-h-screen p-6 space-y-4">
        <h2 class="text-2xl font-bold mb-6">Portal Escolar</h2>
        <nav class="flex flex-col space-y-3">
            <a href="{{ route('responsavel.dashboard') }}"
                class="hover:bg-blue-700 px-3 py-2 rounded transition">Dashboard</a>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="hover:bg-blue-700 px-3 py-2 rounded transition">Sair</a>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </aside>

    <main class="flex-1 p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>