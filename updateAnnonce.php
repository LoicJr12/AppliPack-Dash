<?php include 'updateAnnonce.inc.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
  <h1 class="h4 mb-3">Modifier l’annonce</h1>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger"><ul class="mb-0">
      <?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
    </ul></div>
  <?php endif; ?>

  <form method="post" novalidate>
    <!-- Infos annonce -->
    <div class="card mb-4">
      <div class="card-header">Informations générales</div>
      <div class="card-body row g-3">
        <div class="col-md-6">
          <label class="form-label">Titre</label>
          <input type="text" name="titre" class="form-control" value="<?= htmlspecialchars($annonce['titre']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Nombre de déménageurs</label>
          <input type="number" name="nbreDemenageur" class="form-control" min="1" value="<?= (int)$annonce['nbreDemenageur'] ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Date</label>
          <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($annonce['date']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Heure</label>
          <input type="time" name="heure" class="form-control" value="<?= htmlspecialchars(substr($annonce['heure'],0,5)) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Volume total (m³)</label>
          <input type="number" step="0.1" min="0" name="volumeTotal" class="form-control" value="<?= htmlspecialchars($annonce['volumeTotal']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Poids total (kg)</label>
          <input type="number" step="0.1" min="0" name="poidsTotal" class="form-control" value="<?= htmlspecialchars($annonce['poidsTotal']) ?>">
        </div>
        <div class="col-12">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($annonce['description']) ?></textarea>
        </div>
      </div>
    </div>

    <!-- Logement de départ -->
    <div class="card mb-4">
      <div class="card-header">Logement de départ</div>
      <div class="card-body row g-3">
        <div class="col-md-6">
          <label class="form-label">Ville</label>
          <input type="text" name="ville_depart" class="form-control" value="<?= htmlspecialchars($depart['ville']) ?>" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Étage</label>
          <input type="number" name="etage_depart" min="0" class="form-control" value="<?= (int)$depart['etage'] ?>" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Ascenseur</label>
          <select name="ascenseur_depart" class="form-select" required>
            <option value="oui" <?= ($depart['ascenceur']==='oui'?'selected':'') ?>>Oui</option>
            <option value="non" <?= ($depart['ascenceur']==='non'?'selected':'') ?>>Non</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Statut</label>
          <input type="text" name="statut_depart" class="form-control" value="<?= htmlspecialchars($depart['statut']) ?>">
        </div>
      </div>
    </div>

    <!-- Logement d’arrivée -->
    <div class="card mb-4">
      <div class="card-header">Logement d’arrivée</div>
      <div class="card-body row g-3">
        <div class="col-md-6">
          <label class="form-label">Ville</label>
          <input type="text" name="ville_arrivee" class="form-control" value="<?= htmlspecialchars($arrivee['ville']) ?>" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Étage</label>
          <input type="number" name="etage_arrivee" min="0" class="form-control" value="<?= (int)$arrivee['etage'] ?>" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Ascenseur</label>
          <select name="ascenseur_arrivee" class="form-select" required>
            <option value="oui" <?= ($arrivee['ascenceur']==='oui'?'selected':'') ?>>Oui</option>
            <option value="non" <?= ($arrivee['ascenceur']==='non'?'selected':'') ?>>Non</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Statut</label>
          <input type="text" name="statut_arrivee" class="form-control" value="<?= htmlspecialchars($arrivee['statut']) ?>">
        </div>
      </div>
    </div>

    <div class="text-end">
      <button class="btn btn-primary" type="submit">Enregistrer les modifications</button>
    </div>
  </form>
</div>
</body>
</html>
