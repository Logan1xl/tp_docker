<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; /* Light background for modern look */
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #343a40; /* Dark footer */
            color: #ffffff;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .dropdown-menu {
            border-radius: 0.5rem;
        }

        .btn-light {
            border: 1px solid #0d6efd;
        }

        .alert {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Request App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fa fa-home" aria-hidden="true"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mes Requêtes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Mes requêtes</a></li>
                            <li><a class="dropdown-item" href="#">Rechercher les étudiants</a></li>
                            <li><a class="dropdown-item" href="#">Archiver</a></li>
                            <li><a class="dropdown-item" href="#">Désarchiver</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Paramètres</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light text-primary" href="#">
                            <i class="fa fa-check-circle" aria-hidden="true"></i> Se connecter
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main mt-4">
        <section>
            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield("contenu")
        </section>
    </div>

    <!-- Footer -->
    <footer class="text-center p-3 mt-4">
        <div class="d-flex justify-content-center align-items-center">
            <span>&copy; @cs2i, {{ date('Y') }}</span>
            <span class="mx-3 border-start border-white" style="height: 20px;"></span>
            <span>Développement Backend</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
