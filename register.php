<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$title = "Inscription - Pack & Dash";
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
    <link rel="stylesheet" href="styles/footer.inc.css">
    <!-- Style spécifique pour cette page -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <?php include 'register.inc.php'; ?>
    <?php include 'footer.inc.php'; ?>
    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour gérer les champs dynamiques -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const clientFields = document.querySelectorAll('.client-fields');
            const moverFields = document.querySelectorAll('.mover-fields');

            // Cache les champs spécifiques au chargement de la page
            clientFields.forEach(field => field.style.display = 'none');
            moverFields.forEach(field => field.style.display = 'none');

            typeSelect.addEventListener('change', function() {
                if (this.value === 'client') {
                    clientFields.forEach(field => field.style.display = 'block');
                    moverFields.forEach(field => field.style.display = 'none');
                } else if (this.value === 'mover') {
                    clientFields.forEach(field => field.style.display = 'none');
                    moverFields.forEach(field => field.style.display = 'block');
                }
            });
        });
    </script>
</body>
</html>
