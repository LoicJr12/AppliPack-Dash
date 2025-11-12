<?php
session_start(); // Démarrer la session ici
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Client - Pack & Dash</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers les fichiers CSS existants -->
    <link rel="stylesheet" href="assets/styles/body.inc.css">
    <link rel="stylesheet" href="assets/styles/footer.inc.css">
    <link rel="stylesheet" href="assets/styles/navbar.inc.css">
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <?php include 'customer.inc.php'; ?>
    <?php include 'footer.inc.php'; ?>
    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
