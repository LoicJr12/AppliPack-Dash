<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once 'bdd.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$errors = [];
$conn   = connectToDatabase();
$conn->set_charset('utf8mb4');

// Auth
if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.inc.php"); exit();
}
$idUtilisateur = (int)$_SESSION['idUtilisateur'];

// idAnnonce requis
$idAnnonce = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($idAnnonce <= 0) { header("Location: customerPage.php"); exit(); }

// Récup idClient du user
$sql = "SELECT c.idClient
        FROM Client c
        JOIN Utilisateur u ON u.idUtilisateur = c.idUtilisateur
        WHERE u.idUtilisateur = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idUtilisateur);
$stmt->execute();
$rowC = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$rowC) { header("Location: customerPage.php"); exit(); }
$idClient = (int)$rowC['idClient'];

// Charger annonce (et vérifier propriétaire)
$sqlA = "SELECT idAnnonce, titre, description, `date`, `heure`,
                nbreDemenageur, volumeTotal, poidsTotal, idClient
         FROM Annonce WHERE idAnnonce = ?";
$stmtA = $conn->prepare($sqlA);
$stmtA->bind_param("i", $idAnnonce);
$stmtA->execute();
$annonce = $stmtA->get_result()->fetch_assoc();
$stmtA->close();

if (!$annonce || (int)$annonce['idClient'] !== $idClient) {
    // annonce inexistante ou n’appartient pas à ce client
    header("Location: customerPage.php"); exit();
}

// Charger logements existants
$sqlL = "SELECT ville, etage, ascenceur, statut, `type`
         FROM Logement WHERE idAnnonce = ?";
$stmtL = $conn->prepare($sqlL);
$stmtL->bind_param("i", $idAnnonce);
$stmtL->execute();
$resL = $stmtL->get_result();

$depart  = ['ville'=>'','etage'=>0,'ascenceur'=>'non','statut'=>''];
$arrivee = ['ville'=>'','etage'=>0,'ascenceur'=>'non','statut'=>''];
while ($lg = $resL->fetch_assoc()) {
    if ($lg['type'] === 'depart')  $depart  = $lg;
    if ($lg['type'] === 'arrivee') $arrivee = $lg;
}
$stmtL->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Annonce
    $titre           = trim($_POST['titre'] ?? '');
    $description     = trim($_POST['description'] ?? '');
    $date            = $_POST['date'] ?? '';
    $heure           = $_POST['heure'] ?? '';
    $nbreDemenageur  = (int)($_POST['nbreDemenageur'] ?? 0);
    $volumeTotal     = (float)($_POST['volumeTotal'] ?? 0);
    $poidsTotal      = (float)($_POST['poidsTotal'] ?? 0);

    // Départ
    $ville_depart    = trim($_POST['ville_depart'] ?? '');
    $etage_depart    = (int)($_POST['etage_depart'] ?? 0);
    $asc_depart      = (($_POST['ascenseur_depart'] ?? '') === 'oui') ? 1 : 0;
    $statut_depart   = trim($_POST['statut_depart'] ?? '');

    // Arrivée
    $ville_arrivee   = trim($_POST['ville_arrivee'] ?? '');
    $etage_arrivee   = (int)($_POST['etage_arrivee'] ?? 0);
    $asc_arrivee     = (($_POST['ascenseur_arrivee'] ?? '') === 'oui') ? 1 : 0;
    $statut_arrivee  = trim($_POST['statut_arrivee'] ?? '');

    // validations basiques
    if ($titre === '')               $errors[] = "Le titre est requis.";
    if ($date === '')                $errors[] = "La date est requise.";
    if ($heure === '')               $errors[] = "L'heure est requise.";
    if ($nbreDemenageur <= 0)        $errors[] = "Le nombre de déménageurs doit être > 0.";
    if ($volumeTotal <= 0)           $errors[] = "Le volume total doit être > 0.";
    if ($ville_depart === '')        $errors[] = "La ville de départ est requise.";
    if ($ville_arrivee === '')       $errors[] = "La ville d’arrivée est requise.";

    if (empty($errors)) {
        try {
            $conn->begin_transaction();

            // UPDATE annonce
            $sqlUpA = "UPDATE Annonce SET
                         titre=?, description=?, `date`=?, `heure`=?,
                         nbreDemenageur=?, volumeTotal=?, poidsTotal=?
                       WHERE idAnnonce=? AND idClient=?";
            $stmtUpA = $conn->prepare($sqlUpA);
            $stmtUpA->bind_param(
                "ssssiddii",
                $titre, $description, $date, $heure,
                $nbreDemenageur, $volumeTotal, $poidsTotal,
                $idAnnonce, $idClient
            );
            $stmtUpA->execute();
            $stmtUpA->close();

            // UPDATE/INSERT logements
            // Départ
            $sqlCheck = "SELECT 1 FROM Logement WHERE idAnnonce=? AND `type`='depart'";
            $st = $conn->prepare($sqlCheck);
            $st->bind_param("i", $idAnnonce);
            $st->execute();
            $existsDepart = (bool)$st->get_result()->fetch_row();
            $st->close();

            if ($existsDepart) {
                $sqlUpd = "UPDATE Logement
                          SET ville=?, etage=?, ascenceur=?, statut=?
                          WHERE idAnnonce=? AND `type`='depart'";
                $su = $conn->prepare($sqlUpd);
                $su->bind_param("sissi", $ville_depart, $etage_depart, $asc_depart, $statut_depart, $idAnnonce);
                $su->execute(); $su->close();
            } else {
                $sqlIns = "INSERT INTO Logement (ville, etage, ascenceur, statut, `type`, idAnnonce)
                           VALUES (?,?,?,?, 'depart', ?)";
                $si = $conn->prepare($sqlIns);
                $si->bind_param("sissi", $ville_depart, $etage_depart, $asc_depart, $statut_depart, $idAnnonce);
                $si->execute(); $si->close();
            }

            // Arrivée
            $st = $conn->prepare("SELECT 1 FROM Logement WHERE idAnnonce=? AND `type`='arrivee'");
            $st->bind_param("i", $idAnnonce);
            $st->execute();
            $existsArr = (bool)$st->get_result()->fetch_row();
            $st->close();

            if ($existsArr) {
                $sqlUpd = "UPDATE Logement
                          SET ville=?, etage=?, ascenceur=?, statut=?
                          WHERE idAnnonce=? AND `type`='arrivee'";
                $su = $conn->prepare($sqlUpd);
                $su->bind_param("sissi", $ville_arrivee, $etage_arrivee, $asc_arrivee, $statut_arrivee, $idAnnonce);
                $su->execute(); $su->close();
            } else {
                $sqlIns = "INSERT INTO Logement (ville, etage, ascenceur, statut, `type`, idAnnonce)
                           VALUES (?,?,?,?, 'arrivee', ?)";
                $si = $conn->prepare($sqlIns);
                $si->bind_param("sissi", $ville_arrivee, $etage_arrivee, $asc_arrivee, $statut_arrivee, $idAnnonce);
                $si->execute(); $si->close();
            }

            $conn->commit();
            header("Location: customerPage.php"); exit();

        } catch (Throwable $e) {
            $conn->rollback();
            $errors[] = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
}
