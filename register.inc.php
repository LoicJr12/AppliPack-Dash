<div class="container-fluid">
    <div class="row">
        <!-- Partie gauche -->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white p-5"
             style="background: linear-gradient(135deg, #4285F4, #346CB0); height: 100vh;">
            <h1 class="display-4">Pack & Dash</h1>
            <p class="lead">Organisez vos déménagements en toute simplicité.</p>
        </div>

        <!-- Partie droite -->
        <div class="col-md-6 d-flex align-items-center justify-content-center"
             style="background-color: #f8f9fa; height: 100vh;">
            <div class="w-75">
                <div class="card shadow">
                    <div class="card-header text-center bg-white">
                        <h3>Inscription</h3>
                    </div>
                    <div class="card-body">

                        <?php if (!empty($errorMessage)): ?>
                            <div class="alert alert-danger">
                                <?= htmlspecialchars($errorMessage) ?>
                            </div>
                        <?php endif; ?>

                        <form action="register.php" method="post">
                            <!-- Nom d'utilisateur -->
                            <div class="mb-3">
                                <label for="userName" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="userName" name="userName"
                                       value="<?= htmlspecialchars($_POST['userName'] ?? '') ?>" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                            </div>

                            <!-- Mot de passe -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <!-- Type de compte -->
                            <div class="mb-3">
                                <label for="type" class="form-label">Type de compte</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Choisir...</option>
                                    <option value="client" <?= (($_POST['type'] ?? '') === 'client') ? 'selected' : '' ?>>Client</option>
                                    <option value="demenageur" <?= (($_POST['type'] ?? '') === 'demenageur') ? 'selected' : '' ?>>Déménageur</option>
                                </select>
                            </div>

                            <!-- Champs Client -->
                            <div class="mb-3 client-fields">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom"
                                       value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" >
                            </div>
                            <div class="mb-3 client-fields">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom"
                                     value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" >
                            </div>
                            <div class="mb-3 client-fields" style="display: none;">
                                <label for="contact_client" class="form-label">contact</label>
                                <input type="tel" class="form-control" id="contact_client" name="contact_client" placeholder="format : 0000000000"
                                    maxlength="10" pattern="[0-9]{10}" value="<?= htmlspecialchars($_POST['contact_client'] ?? '') ?>" >
                            </div>

                            <!-- Champs Déménageur -->
                            <div class="mb-3 mover-fields" style="display: none;">
                                <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                                <input type="text" class="form-control" id="nomEntreprise" name="nomEntreprise"
                                       value="<?= htmlspecialchars($_POST['nomEntreprise'] ?? '') ?>" >
                            </div>
                            <div class="mb-3 mover-fields" style="display: none;">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse"
                                    placeholder="2 avenue cdg 75001 PARIS"   value="<?= htmlspecialchars($_POST['adresse'] ?? '') ?>" >
                            </div>
                            <div class="mb-3 mover-fields" style="display: none;">
                                <label for="contact_demenageur" class="form-label">contact</label>
                                <input type="tel" class="form-control" id="contact_demenageur" name="contact_demenageur" placeholder="format : 0000000000"
                                    maxlength="10" pattern="[0-9]{10}" value="<?= htmlspecialchars($_POST['contact_demenageur'] ?? '') ?>" >
                            </div>

                            <!-- Bouton -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Déjà un compte ? <a href="login.inc.php">Se connecter</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
