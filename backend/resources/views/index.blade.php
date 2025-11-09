@extends("welcome")
@section("contenu")

    <!-- Contenu principal -->
    <main class="flex-grow-1 d-flex flex-column align-items-center justify-content-center text-center p-4">
        
        <h1 class="fw-bold">Bienvenue sur Request App</h1>
        <p class="mt-3">
            <p>Je suis nouveau : <a href="{{route("inscription")}}" class="text-primary">créer un compte</a></p>
        </p>
        <p>
            <p>Je suis étudiant : <a href="#" class="text-primary">connectez-vous</a></p>
        </p>
    </main>

@endsection
