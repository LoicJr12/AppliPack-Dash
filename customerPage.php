<?php
session_start();

// Titre de la page
$title = "Espace Client - Pack & Dash";

// Connexion DB
require_once 'bdd.php';
$conn = connectToDatabase();

// Vérifier la session
if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.inc.php");
    exit();
}

$idUtilisateur = (int) $_SESSION['idUtilisateur'];

/* =========================
   1) Infos client (+ idClient)
   ========================= */
$sql = "SELECT u.userName, u.email, c.nom, c.prenom, c.contact, c.idClient
        FROM Utilisateur u
        JOIN Client c ON u.idUtilisateur = c.idUtilisateur
        WHERE u.idUtilisateur = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idUtilisateur);
$stmt->execute();
$result = $stmt->get_result();
$customerInfo = $result->fetch_assoc();

if (!$customerInfo) {
    $stmt->close();
    $conn->close();
    header("Location: login.inc.php");
    exit();
}

$idClient = (int) $customerInfo['idClient'];
$stmt->close();

/* =========================
   2) Annonces du client
   ========================= */
$sqlAnnouncements = "SELECT idAnnonce, titre, description, `date`, `heure`, nbreDemenageur, volumeTotal, poidsTotal
                     FROM Annonce
                     WHERE idClient = ?
                     ORDER BY idAnnonce DESC";
$stmtAnnouncements = $conn->prepare($sqlAnnouncements);
$stmtAnnouncements->bind_param("i", $idClient);
$stmtAnnouncements->execute();
$resultAnnouncements = $stmtAnnouncements->get_result();

$annonces = [];
while ($row = $resultAnnouncements->fetch_assoc()) {
    $annonces[] = $row;
}
$stmtAnnouncements->close();

/* =========================
   3) Requêtes réutilisables
   ========================= */
// Images
$stmtImages = $conn->prepare("SELECT idImage, url FROM Image WHERE idAnnonce = ?");
// Logements (départ/arrivée)
$stmtLogements = $conn->prepare("
    SELECT ville, etage, ascenceur, statut, `type`
    FROM Logement
    WHERE idAnnonce = ?
");

function niceAsc($v){ return ($v === 'oui') ? 'Oui' : 'Non'; }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($title) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/footer.inc.css">
</head>
<body class="d-flex flex-column min-vh-100">
  <!-- NAV -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">Pack &amp; Dash</a>
      <div class="d-flex">
        <a href="logout.inc.php" class="btn btn-outline-danger">Déconnexion</a>
      </div>
    </div>
  </nav>

  <!-- CONTENU -->
  <main class="container flex-fill mt-4">
    <h1 class="mb-4">
      Bienvenue dans votre espace client, <?= htmlspecialchars($customerInfo['nom'] ?? 'Utilisateur') ?> !
    </h1>

    <div class="d-flex justify-content-end mb-3">
      <a href="newAnnonce.php" class="btn btn-primary">Créer une nouvelle annonce</a>
    </div>

    <h2 class="mb-3">Vos annonces</h2>

    <?php if (empty($annonces)): ?>
      <div class="alert alert-info">Vous n'avez pas encore créé d'annonces.</div>
    <?php else: ?>
      <div class="row">
        <?php foreach ($annonces as $annonce): ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= htmlspecialchars($annonce['titre']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($annonce['description']) ?></p>
                <p class="card-text"><small class="text-muted">Date : <?= htmlspecialchars($annonce['date']) ?></small></p>
                <p class="card-text"><small class="text-muted">Heure : <?= htmlspecialchars($annonce['heure']) ?></small></p>
                <p class="card-text"><small class="text-muted">Déménageurs : <?= (int)$annonce['nbreDemenageur'] ?></small></p>
                <p class="card-text"><small class="text-muted">Volume : <?= htmlspecialchars($annonce['volumeTotal']) ?> m³</small></p>
                <p class="card-text"><small class="text-muted">Poids : <?= htmlspecialchars($annonce['poidsTotal']) ?> kg</small></p>

                <!-- Trajet (Logements) -->
                <?php
  $idAnnonce = (int)$annonce['idAnnonce'];
  $stmtLogements->bind_param("i", $idAnnonce);
  $stmtLogements->execute();
  $resLog = $stmtLogements->get_result();

  $depart  = null;
  $arrivee = null;
  while ($lg = $resLog->fetch_assoc()) {
      if ($lg['type'] === 'depart')  { $depart  = $lg; }
      if ($lg['type'] === 'arrivee') { $arrivee = $lg; }
  }
?>
<div class="mt-2">
  <h6 class="fw-bold mb-2">Informations sur les logements</h6>

  <div class="mb-2">
    <div class="fw-semibold text-primary">Logement de départ</div>
    <?php if ($depart): ?>
      <div class="ms-1">
        <div><strong>Ville :</strong> <?= htmlspecialchars($depart['ville']) ?></div>
        <div><strong>Étage :</strong> <?= (int)$depart['etage'] ?></div>
        <div><strong>Ascenseur :</strong> <?= niceAsc($depart['ascenceur']) ?></div>
        <?php if (!empty($depart['statut'])): ?>
          <div><strong>Statut :</strong> <?= htmlspecialchars($depart['statut']) ?></div>
        <?php endif; ?>
      </div>
    <?php else: ?>
      <span class="text-muted">Non renseigné.</span>
    <?php endif; ?>
  </div>

  <div class="mb-2">
    <div class="fw-semibold text-success">Logement d’arrivée</div>
    <?php if ($arrivee): ?>
      <div class="ms-1">
        <div><strong>Ville :</strong> <?= htmlspecialchars($arrivee['ville']) ?></div>
        <div><strong>Étage :</strong> <?= (int)$arrivee['etage'] ?></div>
        <div><strong>Ascenseur :</strong> <?= niceAsc($arrivee['ascenceur']) ?></div>
        <?php if (!empty($arrivee['statut'])): ?>
          <div><strong>Statut :</strong> <?= htmlspecialchars($arrivee['statut']) ?></div>
        <?php endif; ?>
      </div>
    <?php else: ?>
      <span class="text-muted">Non renseigné.</span>
    <?php endif; ?>
  </div>
</div>


                <!-- Images -->
                <div class="mt-2 mb-3">
                  <h6>Images associées :</h6>
                  <?php
                    $stmtImages->bind_param("i", $idAnnonce);
                    $stmtImages->execute();
                    $resImg = $stmtImages->get_result();
                    if ($resImg->num_rows > 0) {
                        while ($image = $resImg->fetch_assoc()) {
                            echo '<div class="mb-2">';
                            echo '<a href="downloadImage.php?id=' . (int)$image['idImage'] . '" class="btn btn-sm btn-info">Télécharger Image</a>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-muted mb-0">Aucune image associée.</p>';
                    }
                  ?>
                </div>

                <div class="mt-auto d-flex gap-2">
                  <a href="updateAnnonce.php?id=<?= (int)$annonce['idAnnonce'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                  <a href="deleteAnnonce.php?id=<?= (int)$annonce['idAnnonce'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                  <a href="moverList.php?id=<?= (int)$annonce['idAnnonce'] ?>" class="btn btn-sm btn-success">Voir les propositions</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main>

  <!-- FOOTER -->
  <?php include 'footer.inc.php'; ?>

  <?php
    // fermer proprement
    $stmtImages->close();
    $stmtLogements->close();
    $conn->close();
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
