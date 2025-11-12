<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header text-center bg-primary text-white">
                    <h3>Nouvelle Annonce</h3>
                </div>
                <div class="card-body">
                    <form action="newAnnonce.php" method="post">
                        <!-- Champ Titre -->
                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre de l'annonce</label>
                            <input type="text" class="form-control" id="titre" name="titre" required>
                        </div>
                        <!-- Champ Date -->
                        <div class="mb-3">
                            <label for="date" class="form-label">Date du déménagement</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <!-- Champ Heure -->
                        <div class="mb-3">
                            <label for="heure" class="form-label">Heure du déménagement</label>
                            <input type="time" class="form-control" id="heure" name="heure" required>
                        </div>
                        <!-- Champ Ville de départ -->
                        <div class="mb-3">
                            <label for="villeDepart" class="form-label">Ville de départ</label>
                            <input type="text" class="form-control" id="villeDepart" name="villeDepart" required>
                        </div>
                        <!-- Champ Adresse de départ -->
                        <div class="mb-3">
                            <label for="adresseDepart" class="form-label">Adresse de départ</label>
                            <input type="text" class="form-control" id="adresseDepart" name="adresseDepart" required>
                        </div>
                        <!-- Champ Ville d'arrivée -->
                        <div class="mb-3">
                            <label for="villeArrivee" class="form-label">Ville d'arrivée</label>
                            <input type="text" class="form-control" id="villeArrivee" name="villeArrivee" required>
                        </div>
                        <!-- Champ Adresse d'arrivée -->
                        <div class="mb-3">
                            <label for="adresseArrivee" class="form-label">Adresse d'arrivée</label>
                            <input type="text" class="form-control" id="adresseArrivee" name="adresseArrivee" required>
                        </div>
                        <!-- Champ Type de logement -->
                        <div class="mb-3">
                            <label for="typeLogement" class="form-label">Type de logement</label>
                            <select class="form-select" id="typeLogement" name="typeLogement" required>
                                <option value="">Sélectionnez un type de logement</option>
                                <option value="appartement">Appartement</option>
                                <option value="maison">Maison</option>
                                <option value="studio">Studio</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        <!-- Champ Volume à déménager -->
                        <div class="mb-3">
                            <label for="volume" class="form-label">Volume à déménager (en m³)</label>
                            <input type="number" class="form-control" id="volume" name="volume" required>
                        </div>
                        <!-- Champ Nombre de déménageurs nécessaires -->
                        <div class="mb-3">
                            <label for="nbreDemenageur" class="form-label">Nombre de déménageurs nécessaires</label>
                            <input type="number" class="form-control" id="nbreDemenageur" name="nbreDemenageur" required>
                        </div>
                        <!-- Champ Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <!-- Boutons -->
                        <div class="d-flex justify-content-between">
                            <a href="customerPage.php" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">Publier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
