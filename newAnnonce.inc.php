<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h3>Nouvelle Annonce</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="newAnnonce.php">
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
                        <!-- Champ Nombre de déménageurs nécessaires -->
                        <div class="mb-3">
                            <label for="nbreDemenageur" class="form-label">Nombre de déménageurs nécessaires</label>
                            <input type="number" class="form-control" id="nbreDemenageur" name="nbreDemenageur" required>
                        </div>
                        <!-- Champ Volume à déménager -->
                        <div class="mb-3">
                            <label for="volumeTotal" class="form-label">Volume à déménager (en m³)</label>
                            <input type="number" class="form-control" id="volumeTotal" name="volumeTotal" required>
                        </div>
                        <!-- Champ Poids total -->
                        <div class="mb-3">
                            <label for="poidsTotal" class="form-label">Poids total (en kg)</label>
                            <input type="number" class="form-control" id="poidsTotal" name="poidsTotal" required>
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
