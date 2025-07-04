<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Dashboard do Professor') | Portal Escolar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 min-h-screen">

    <header class="bg-blue-800 text-white p-4 shadow flex justify-between items-center">
        <h1 class="text-xl font-bold">Portal Escolar - Professor</h1>

    </header>

    <main class="container mx-auto p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>