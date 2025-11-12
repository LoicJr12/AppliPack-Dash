<div class="container-fluid">
    <div class="row">
        <!-- Partie gauche avec le nom de l'application et une image ou un logo -->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white p-5" style="background: linear-gradient(135deg, #4285F4, #346CB0); height: 100vh;">
            <h1 class="display-4">Pack & Dash</h1>
            <p class="lead">Organisez vos déménagements en toute simplicité.</p>
        </div>
        <!-- Partie droite avec le formulaire -->
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa; height: 100vh;">
            <div class="w-75">
                <div class="card shadow">
                    <div class="card-header text-center bg-white">
                        <h3>Inscription</h3>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="post">
                            <!-- Champ Nom d'utilisateur -->
                            <div class="mb-3">
                                <label for="userName" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="userName" name="userName" required>
                            </div>
                            <!-- Champ Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <!-- Champ Mot de passe -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <!-- Champ Type de compte -->
                            <div class="mb-3">
                                <label for="type" class="form-label">Type de compte</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="client">Client</option>
                                    <option value="demenageur">Déménageur</option>
                                </select>
                            </div>
                            <!-- Champs spécifiques pour Client -->
                            <div class="mb-3 client-fields">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom">
                            </div>
                            <div class="mb-3 client-fields">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom">
                            </div>
                            <!-- Champs spécifiques pour Déménageur -->
                            <div class="mb-3 mover-fields" style="display: none;">
                                <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                                <input type="text" class="form-control" id="nomEntreprise" name="nomEntreprise">
                            </div>
                            <div class="mb-3 mover-fields" style="display: none;">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse">
                            </div>
                            <!-- Bouton de soumission -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
