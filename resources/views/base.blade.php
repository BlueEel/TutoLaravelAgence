<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

    <script src="https://kit.fontawesome.com/feed0b9777.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.scss', 'resources/js/app.js'])

    <title>@yield('title') | Agence Immo</title>

</head>
<body>

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Agence Immo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @php
                $route = request()->route()->getName();
            @endphp

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('property.index') }}" @class(['nav-link', 'active' => str_contains($route, 'property.')])>Nos Biens</a>
                    </li>
                    <li class="nav-item">
                        <a href="/" @class(['nav-link'])>Actualités</a>
                    </li>
                   <li class="nav-item">
                        <a href="/" @class(['nav-link'])>Contact</a>
                    </li>
                </ul>
            </div>

            <div class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        @guest
                            <a href=" {{ route('login')}}" @class(['poppins-regular','nav-link', 'active' => str_contains($route, 'login.')])>
                                <i class="fa-regular fa-user me-2"></i>
                                Se connecter
                            </a>
                        @endguest
                    </li>
                    <li>
                        @auth
                            <a href=" {{ route('admin.property.index')}}" @class(['nav-link', 'active' => str_contains($route, 'admin.')])>Dashboard Admin</a>
                        @endauth
                    </li>
                </ul>
            </div>




        </div>
    </nav>
    @yield('content')
</body>
</html>
