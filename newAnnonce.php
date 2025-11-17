<?php include 'newAnnonce.inc.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title ?? 'Créer une annonce') ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/footer.inc.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-light bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand" href="index.php">Pack &amp; Dash</a>
    <div class="d-flex gap-2">
      <a href="customerPage.php" class="btn btn-outline-secondary">Retour</a>
      <a href="logout.inc.php" class="btn btn-outline-danger">Déconnexion</a>
    </div>
  </div>
</nav>

<div class="container my-4">
  <h1 class="h3 mb-4">Nouvelle annonce</h1>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach ($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <!-- IMPORTANT: enctype pour uploader des fichiers -->
  <form method="post" enctype="multipart/form-data" novalidate>
    <!-- INFOS ANNONCE -->
    <div class="card mb-4">
      <div class="card-header">Informations générales</div>
      <div class="card-body row g-3">
        <div class="col-md-6">
          <label class="form-label">Titre</label>
          <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Nombre de déménageurs</label>
          <input type="number" name="nbreDemenageur" class="form-control" min="1" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Date</label>
          <input type="date" name="date" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Heure</label>
          <input type="time" name="heure" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Volume total (m³)</label>
          <input type="number" name="volumeTotal" class="form-control" step="0.1" min="0" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Poids total (kg)</label>
          <input type="number" name="poidsTotal" class="form-control" step="0.1" min="0">
        </div>
        <div class="col-12">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Détails utiles..."></textarea>
        </div>
      </div>
    </div>

    <!-- LOGEMENT DÉPART -->
    <div class="card mb-4">
      <div class="card-header">Logement de départ</div>
      <div class="card-body row g-3">
        <div class="col-md-6">
          <label class="form-label">Ville</label>
          <input type="text" name="ville_depart" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Étage</label>
          <input type="number" name="etage_depart" class="form-control" min="0" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Ascenseur</label>
          <select name="ascenseur_depart" class="form-select" required>
            <option value="">-- Sélectionnez --</option>
            <option value="oui">Oui</option>
            <option value="non">Non</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Statut</label>
          <input type="text" name="statut_depart" class="form-control" placeholder="meublé / vide / ...">
        </div>
        <div class="col-md-6">
          <label class="form-label">Type de logement</label>
          <input type="text" name="type_depart_logement" class="form-control" placeholder="appartement / maison / ...">
          <!-- NOTE: ce champ est optionnel. Si tu veux le stocker, ajoute une colonne dédiée (ex: typeLogement). -->
        </div>
      </div>
    </div>

    <!-- LOGEMENT ARRIVÉE -->
    <div class="card mb-4">
      <div class="card-header">Logement d'arrivée</div>
      <div class="card-body row g-3">
        <div class="col-md-6">
          <label class="form-label">Ville</label>
          <input type="text" name="ville_arrivee" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Étage</label>
          <input type="number" name="etage_arrivee" class="form-control" min="0" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Ascenseur</label>
          <select name="ascenseur_arrivee" class="form-select" required>
            <option value="">-- Sélectionnez --</option>
            <option value="oui">Oui</option>
            <option value="non">Non</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Statut</label>
          <input type="text" name="statut_arrivee" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Type de logement</label>
          <input type="text" name="type_arrivee_logement" class="form-control">
          <!-- NOTE: idem, champ libre non stocké par défaut -->
        </div>
      </div>
    </div>

    <!-- IMAGES -->
    <div class="card mb-4">
      <div class="card-header">Photos (facultatif)</div>
      <div class="card-body">
        <input type="file" name="images[]" class="form-control" multiple
               accept=".jpg,.jpeg,.png,.gif,.webp">
        <small class="text-muted">Formats: JPG/PNG/GIF/WebP — max 5 Mo par image.</small>
      </div>
    </div>

    <div class="text-end">
      <button type="submit" class="btn btn-primary">Créer l’annonce</button>
    </div>
  </form>
</div>

<?php include 'footer.inc.php'; ?>
</body>
</html>
