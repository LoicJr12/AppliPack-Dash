<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$title = "Inscription - Pack & Dash";

// Inclure la connexion BDD
require_once 'bdd.php';

$errorMessage = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $userName = trim($_POST['userName'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $type     = $_POST['type'] ?? '';

    // Champs spécifiques
    $nom           = trim($_POST['nom'] ?? '');
    $prenom        = trim($_POST['prenom'] ?? '');
    $nomEntreprise = trim($_POST['nomEntreprise'] ?? '');
    $adresse       = trim($_POST['adresse'] ?? '');
    $contact_demenageur = trim($_POST['contact_demenageur'] ?? '');
    $contact_client = trim($_POST['contact_client'] ?? '');

    // Vérifications rapides
    if ($userName === '' || $email === '' || $password === '' || ($type !== 'client' && $type !== 'demenageur')) {
        $errorMessage = "Veuillez remplir tous les champs.";
        if(($type === 'client') && ($nom === '' || $prenom === '' || !ctype_digit($contact_client))){
            $errorMessage = "Veuillez les champs noms, prenoms et contact au bon format";
        }

        if(($type === 'demenageur') && ($nom === '' || $prenom === '' || !ctype_digit($contact_demenageur))){
            $errorMessage = "Veuillez les champs nomEntreprise, Addrese et contact au bon format";
        }
    } else {
        try {
            $conn = connectToDatabase();
            $conn->begin_transaction();

            // Hash du mot de passe
            $hash = password_hash($password, PASSWORD_DEFAULT);

           // 1) Insertion dans Utilisateur
$sqlUser = "INSERT INTO Utilisateur (userName, email, password, type)
            VALUES (?, ?, ?, ?)";

$stmtUser = $conn->prepare($sqlUser);
if (!$stmtUser) {
    die("Erreur préparation requête Utilisateur : " . $conn->error);
}

$stmtUser->bind_param("ssss", $userName, $email, $hash, $type);
$stmtUser->execute();

$idUtilisateur = $conn->insert_id;
$stmtUser->close();


            // 2) Insertion dans Client ou Demenageur
            if ($type === 'client') {
                $sqlClient = "INSERT INTO Client (nom, prenom, contact, idUtilisateur)
                              VALUES (?, ?, ?, ?)";
                $stmtClient = $conn->prepare($sqlClient);
                $stmtClient->bind_param("sssi", $nom, $prenom, $contact_client, $idUtilisateur);
                $stmtClient->execute();
                $stmtClient->close();
            } else {
                // type === 'demenageur'
                $sqlDem = "INSERT INTO Demenageur (nomEntreprise, adresse, contact, idUtilisateur)
                           VALUES (?, ?, ?, ?)";
                $stmtDem = $conn->prepare($sqlDem);
                $stmtDem->bind_param("sssi", $nomEntreprise, $adresse, $contact_demenageur, $idUtilisateur);
                $stmtDem->execute();
                $stmtDem->close();
            }

            // Tout est OK
            $conn->commit();

            // Création de la session
            $_SESSION['idUtilisateur'] = $idUtilisateur;
            $_SESSION['type'] = $type;

            // Redirection selon le type
            if ($type === 'client') {
                header("Location: customerPage.php");
            } else {
                // ⚠️ adapte le nom de la page déménageur
                header("Location: demenageur.inc.php");
            }
            exit();

        } catch (Throwable $e) {
            if (isset($conn)) {
                $conn->rollback();
            }
            // En prod : message générique / en dev : afficher l’erreur
            $errorMessage = "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/footer.inc.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

    <?php
    // On a besoin de $errorMessage et des valeurs POST dans le formulaire
    include 'register.inc.php';
    ?>

    <?php include 'footer.inc.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour gérer les champs dynamiques -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const clientFields = document.querySelectorAll('.client-fields');
            const moverFields = document.querySelectorAll('.mover-fields');

            // Etat initial : en fonction de la valeur actuelle (utile après une erreur)
            function updateFields() {
                if (typeSelect.value === 'client') {
                    clientFields.forEach(f => f.style.display = 'block');
                    moverFields.forEach(f => f.style.display = 'none');
                } else if (typeSelect.value === 'demenageur') {
                    clientFields.forEach(f => f.style.display = 'none');
                    moverFields.forEach(f => f.style.display = 'block');
                } else {
                    clientFields.forEach(f => f.style.display = 'none');
                    moverFields.forEach(f => f.style.display = 'none');
                }
            }

            updateFields();
            typeSelect.addEventListener('change', updateFields);
        });
    </script>
</body>
</html>
