<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRM')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- NavBar -->
    <nav class="bg-white shadow p-4 flex justify-between">
        <a href="{{ route('contacts.index') }}" class="font-bold text-lg">Meu CRM</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-600 hover:underline">Sair</button>
        </form>
    </nav>

    <!-- Conteúdo principal -->
    <main class="flex-1 container mx-auto p-6">
        @yield('content')
    </main>

    <!-- Footer (opcional) -->
    <footer class="bg-white text-center p-4 text-sm text-gray-500">
        &copy; {{ date('Y') }} Meu CRM
    </footer>

</body>
</html>
