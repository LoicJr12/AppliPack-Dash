<?php
$title = "Liste des propositions - Pack & Dash";
include 'moverList.inc.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Propositions pour l'annonce — Pack & Dash</title>
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
  <div class="mb-4">
    <h1 class="h3 mb-3">Propositions pour : <?= htmlspecialchars($annonce['titre']) ?></h1>
    <p class="mb-1"><strong>Description :</strong> <?= htmlspecialchars($annonce['description']) ?></p>
    <p class="mb-1"><strong>Nombre de demenageur :</strong> <?= htmlspecialchars($annonce['nbreDemenageur']) ?></p>
    <p class="mb-1"><strong>Date de demenagement :</strong> <?= htmlspecialchars($annonce['date']) ?></p>
    <p class="mb-0"><strong>Volume :</strong> <?= htmlspecialchars($annonce['volumeTotal']) ?> m³</p>
    <p class="mb-0"><strong>Poids total :</strong> <?= htmlspecialchars($annonce['poidsTotal']) ?> kg</p>
    <p class="mb-0"><strong>Publié le :</strong> <?= htmlspecialchars($annonce['date_de_publication']) ?> à <?= htmlspecialchars($annonce['heure']) ?></p>
  </div>

  <h2 class="h4 mb-3">Liste des propositions</h2>

  <?php if (empty($propositions)): ?>
    <div class="alert alert-info min-vh-100">Aucune proposition n'a encore été faite pour cette annonce.</div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($propositions as $p): ?>
        <div class="col-md-6 mb-3">
          <div class="card h-100 shadow-sm bg-light">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($p['demenageurName'] ?? 'Déménageur') ?></h5>
              <p><strong>Prix :</strong> <?= htmlspecialchars($p['prixPropose']) ?> €</p>
              <p><strong>Message :</strong> <?= htmlspecialchars($p['message']) ?></p>
              <p><strong>Contact :</strong> <?= htmlspecialchars($p['contact'] ?? '') ?></p>
              <p><strong>Adresse :</strong> <?= htmlspecialchars($p['adresse'] ?? '') ?></p>
              <div class="d-flex flex-row gap-3">
                <a href="accepterPropostion.php?idProposition=<?= (int)$p['idProposition'] ?>&idAnnonce=<?= (int)$idAnnonce ?>"
                 class="btn btn-success">Accepter</a>
                 <a href="refuserProposition.php?idProposition=<?= (int)$p['idProposition'] ?>&idAnnonce=<?= (int)$idAnnonce ?>" class="btn btn-danger">Refuser</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php include('footer.inc.php'); ?>

</body>
</html>
