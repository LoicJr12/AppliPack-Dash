<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php  echo $title  ?></title>
        <link rel="icon" href="assets/Logo.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
        <?php if ($title === 'Login Page'): ?>
            <link rel="stylesheet" href="styles/formLogin.inc.css">
            <link rel="stylesheet" href="styles/footer.inc.css">
        <?php elseif($title === 'Dashboard Demenageur'): ?>
            <link rel="stylesheet" href="styles/navbar.inc.css">
            <link rel="stylesheet" href="styles/search.demenageur.css">
            <link rel="stylesheet" href="styles/sidebar.demenageur.css">
            <link rel="stylesheet" href="styles/formProposition.css">
            <link rel="stylesheet" href="styles/demenageur.inc.css">
            <link rel="stylesheet" href="styles/footer.inc.css">
        <?php elseif($title === 'Details Annonce' || $title === 'Espace Client - Pack & Dash' 
            || $title === 'Liste des propositions - Pack & Dash' || $title  === 'Modifier Annonce - Pack & Dash'): 
        ?>
            <link rel="stylesheet" href="styles/navbar.inc.css">
            <link rel="stylesheet" href="styles/footer.inc.css">
        <?php elseif($title === 'Details Annonce'): ?>
            <link rel="stylesheet" href="styles/footer.inc.css">
        <?php else: ?>
            <link rel="stylesheet" href="styles/navbar.inc.css">
            <link rel="stylesheet" href="styles/body.inc.css">
            <link rel="stylesheet" href="styles/footer.inc.css">
        <?php endif; ?>
    </head>
    <body class="<?php if($title === 'Liste des propositions - Pack & Dash'): $bg = 'bg-light min-vh-100'; echo $bg; endif; ?>">