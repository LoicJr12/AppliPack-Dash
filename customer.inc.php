<?php
include 'customer_functions.php';

// Démarrer la session pour récupérer l'ID de l'utilisateur connecté
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idUtilisateur'])) {
    die("Erreur : Utilisateur non connecté.");
}

$idUtilisateur = $_SESSION['idUtilisateur'];

// Récupérer les informations du client
$customerInfo = getCustomerInfo($idUtilisateur);

// Récupérer les annonces du client
$announcements = getCustomerAnnouncements($idUtilisateur);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Espace Client</h2>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>Mes Informations</h4>
                </div>
                <div class="card-body">
                    <?php if ($customerInfo) : ?>
                        <p><strong>Nom d'utilisateur:</strong> <?php echo htmlspecialchars($customerInfo['userName']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($customerInfo['email']); ?></p>
                        <p><strong>Nom:</strong> <?php echo htmlspecialchars($customerInfo['nom']); ?></p>
                        <p><strong>Prénom:</strong> <?php echo htmlspecialchars($customerInfo['prenom']); ?></p>
                        <p><strong>Contact:</strong> <?php echo htmlspecialchars($customerInfo['contact']); ?></p>
                    <?php else : ?>
                        <p>Impossible de récupérer les informations du client.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>Mes Annonces</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="newAnnonce.php" class="btn btn-success">Créer une annonce</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Date</th>
                                    <th>Ville de départ</th>
                                    <th>Ville d'arrivée</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($announcements)) {
                                    foreach ($announcements as $announcement) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($announcement['titre']) . "</td>";
                                        echo "<td>" . htmlspecialchars($announcement['date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($announcement['villeDepart']) . "</td>";
                                        echo "<td>" . htmlspecialchars($announcement['villeArrivee']) . "</td>";
                                        echo "<td>" . htmlspecialchars($announcement['statut']) . "</td>";
                                        echo '<td><a href="moverList.php?annonce_id=' . $announcement['idAnnonce'] . '" class="btn btn-info btn-sm">Voir les propositions</a></td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>Aucune annonce trouvée.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
