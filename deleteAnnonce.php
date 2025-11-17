<?php
session_start();

// Définir le titre de la page
$title = "Supprimer une Annonce - Pack & Dash";

// Inclure le fichier de connexion à la base de données
include 'bdd.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.inc.php");
    exit();
}

// Vérifier si l'ID de l'annonce est passé dans l'URL
if (!isset($_GET['id'])) {
    header("Location: customerPage.php");
    exit();
}

$idAnnonce = $_GET['id'];

// Connexion à la base de données pour récupérer les informations de l'annonce
$conn = connectToDatabase();
$sql = "SELECT titre FROM Annonce WHERE idAnnonce = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idAnnonce);
$stmt->execute();
$result = $stmt->get_result();
$annonce = $result->fetch_assoc();
$stmt->close();
$conn->close();

// Traitement de la suppression si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectToDatabase();
    $sql = "DELETE FROM Annonce WHERE idAnnonce = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idAnnonce);

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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-danger text-white">
                        <h3>Supprimer une Annonce</h3>
                    </div>
                    <div class="card-body text-center">
                        <p>Êtes-vous sûr de vouloir supprimer l'annonce "<?= htmlspecialchars($annonce['titre']) ?>" ?</p>
                        <p>Cette action est irréversible.</p>
                        <form method="post">
                            <div class="d-flex justify-content-between">
                                <a href="customerPage.php" class="btn btn-secondary">Annuler</a>
                                <button type="submit" class="btn btn-danger">Confirmer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.inc.php'; ?>
    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
