@extends("welcome")

@section("contenu")
<!-- Toast Notifications -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet étudiant?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" action="{{ route('delete_etudiant', ['matricule' => '__MATRICULE__']) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card p-4 shadow-sm">
    <h2 class="mb-4 text-center">Formulaire d'inscription</h2>
    <form action="{{route('enregistrer')}}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Protection contre les attaques CSRF -->

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
            <label for="nom">Nom</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
            <label for="prenom">Prénom</label>
        </div>

        <div class="mb-3">
            <label for="sexe" class="form-label">Sexe</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexe" id="homme" value="H" required>
                    <label class="form-check-label" for="homme">Homme</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexe" id="femme" value="F" required>
                    <label class="form-check-label" for="femme">Femme</label>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>

        <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" required>
            <label for="telephone1">Téléphone</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="login" name="login" placeholder="Login" required>
            <label for="prenom">Login</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder=" Mot de passe" required>
            <label for="password">Mot de passe</label>
        </div>


        <button type="submit" class="btn btn-primary w-100">Envoyer</button>
    </form>
</div>

<div class="card mt-5 p-4 shadow-sm">
    <h3 class="mb-4 text-center text-secondary">Liste des étudiants</h3>
    <table class="table table-bordered table-striped pb-26" >
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Login</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($etudiants as $etudiant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $etudiant->matricule }}</td>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <td>{{ $etudiant->sexe }}</td>
                    <td>{{ $etudiant->email }}</td>
                    <td>{{ $etudiant->telephone }}</td>
                    <td>{{ $etudiant->login }}</td>
                    <td class="text-center">
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteAction('{{ $etudiant->matricule }}')" title="Supprimer">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>

                        <!-- Edit Button -->
                        <a href="" class="btn btn-outline-primary btn-sm ms-2" title="Modifier">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    </td>

                </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Aucun étudiant trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


@endsection

@push('scripts')
<script>
    function setDeleteAction(matricule) {
        const form = document.getElementById('deleteForm');
        const action = form.action.replace('__MATRICULE__', matricule);
        form.action = action;
        console.log('Delete URL:', form.action);
        console.log('Matricule:', matricule);
    }
    // Show toast notifications
    document.addEventListener('DOMContentLoaded', function() {
        const toastEl = document.getElementById('liveToast');
        const toastBody = document.querySelector('.toast-body');
        const toast = new bootstrap.Toast(toastEl);

        @if(session('success'))
            toastBody.textContent = "{{ session('success') }}";
            toastEl.querySelector('.toast-header').classList.add('text-white', 'bg-success');
            toast.show();
        @endif

        @if($errors->any())
            toastBody.textContent = "{{ $errors->first() }}";
            toastEl.querySelector('.toast-header').classList.add('text-white', 'bg-danger');
            toast.show();
        @endif
    });
</script>
