<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestão de consultas') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/estilo-basico.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- Barra de navegação -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Logotipo -->
                <a class="navbar-brand" href="{{ route('consulta.home') }}">
                    {{ 'Gestão de consultas' }}
                </a>
                <!-- Botão para colapsar navbar em telas menores -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links da Navbar -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Links do lado esquerdo (vazio neste caso) -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Links do lado direito -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Links de navegação -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('consulta.home') }}">{{ __('Consultas') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('consulta.create') }}">{{ __('Nova Consulta') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('consulta.relatorios') }}">{{ __('Relatório') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Conteúdo principal -->
        <main class="py-4">
            @yield('conteudo')
        </main>
    </div>
</body>
</html>
