<?php
// Démarrer la session
session_start();

// Définir le titre de la page
$title = "Nouvelle Annonce - Pack & Dash";

// Inclure le fichier de connexion à la base de données
include 'bdd.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.inc.php");
    exit();
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $nbreDemenageur = $_POST['nbreDemenageur'];
    $volumeTotal = $_POST['volumeTotal'];
    $poidsTotal = $_POST['poidsTotal'];
    $description = $_POST['description'];
    $idClient = $_SESSION['idUtilisateur'];
    $dateExacte = new DateTime();
    $date_de_publication = $dateExacte->format('Y-m-d');

    // Connexion à la base de données
    $conn = connectToDatabase();

    // Préparation de la requête SQL
    $sql = "INSERT INTO Annonce (titre, date, heure, nbreDemenageur, volumeTotal, poidsTotal, description, date_de_publication, idClient)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiddssi", $titre, $date, $heure, $nbreDemenageur, $volumeTotal, $poidsTotal, $description, $date_de_publication, $idClient);

    // Exécution de la requête
    if ($stmt->execute()) {
        header("Location: customerPage.php");
        exit();
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers les fichiers CSS existants -->
    <link rel="stylesheet" href="assets/styles/body.inc.css">
    <link rel="stylesheet" href="assets/styles/footer.inc.css">
    <link rel="stylesheet" href="assets/styles/navbar.inc.css">
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <?php include 'newAnnonce.inc.php'; ?>
    <?php include 'footer.inc.php'; ?>
    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
