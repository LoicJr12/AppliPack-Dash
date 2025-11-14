<?php
session_start();

// Titre de la page
$title = "Espace Client - Pack & Dash";

// Inclure le fichier de connexion à la base de données
include 'bdd.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.inc.php");
    exit();
}

// Connexion à la base de données
$conn = connectToDatabase();
$idUtilisateur = $_SESSION['idUtilisateur'];

// Récupérer les informations du client
$sql = "SELECT u.userName, u.email, c.nom, c.prenom, c.contact
        FROM Utilisateur u
        JOIN Client c ON u.idUtilisateur = c.idUtilisateur
        WHERE u.idUtilisateur = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Erreur de préparation de la requête: " . $conn->error);
}
$stmt->bind_param("i", $idUtilisateur);
$stmt->execute();
$result = $stmt->get_result();
$customerInfo = $result->fetch_assoc();

// Récupérer les annonces du client
$sqlAnnouncements = "SELECT idAnnonce, titre, description, date, heure, nbreDemenageur, volumeTotal,poidsTotal 
                     FROM Annonce
                     WHERE idClient = ?";
$stmtAnnouncements = $conn->prepare($sqlAnnouncements);
if (!$stmtAnnouncements) {
    die("Erreur de préparation de la requête: " . $conn->error);
}
$stmtAnnouncements->bind_param("i", $idUtilisateur);
$stmtAnnouncements->execute();
$resultAnnouncements = $stmtAnnouncements->get_result();
$annonces = [];
while ($row = $resultAnnouncements->fetch_assoc()) {
    $annonces[] = $row;
}

$stmt->close();
$stmtAnnouncements->close();
$conn->close();
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
        <a href="login.inc.php" class="btn btn-outline-danger">Déconnexion</a>
      </div>
    </div>
  </nav>
  <!-- CONTENU -->
  <main class="container flex-fill mt-4">
    <h1 class="mb-4">Bienvenue dans votre espace client, <?= htmlspecialchars($customerInfo['nom'] ?? 'Utilisateur') ?> !</h1>
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
                <p class="card-text"><small class="text-muted">Volume : <?= htmlspecialchars($annonce['volumeTotal']) ?> m³</small></p>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
