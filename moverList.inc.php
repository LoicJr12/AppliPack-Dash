<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once 'bdd.php';

$conn = connectToDatabase();
$conn->set_charset('utf8mb4');

// Vérifie que l’utilisateur est connecté
if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.inc.php");
    exit();
}

$idAnnonce = isset($_GET['id']) ? (int)$_GET['id'] : (int)($_GET['idAnnonce'] ?? 0);
if ($idAnnonce <= 0) {
    header("Location: customerPage.php");
    exit();
}

// 1️⃣ Récupération de l'annonce
$sqlAnnonce = "SELECT idAnnonce, titre, description, date, volumeTotal
               FROM Annonce
               WHERE idAnnonce = ?";
$stmtA = $conn->prepare($sqlAnnonce);
$stmtA->bind_param("i", $idAnnonce);
$stmtA->execute();
$annonce = $stmtA->get_result()->fetch_assoc();
$stmtA->close();

if (!$annonce) {
    header("Location: customerPage.php");
    exit();
}

// 2️⃣ Récupération des propositions liées à cette annonce
$sqlProps = "
  SELECT 
    p.idProposition,
    p.prixPropose,
    p.message,
    p.statut,
    d.idDemenageur,
    d.nomEntreprise AS demenageurName,
    d.contact,
    d.addresse AS adresse
  FROM Proposition AS p
  LEFT JOIN Demenageur AS d
         ON p.idDemenageur = d.idDemenageur
  WHERE p.idAnnonce = ?
  ORDER BY p.idProposition DESC
";
$stmtP = $conn->prepare($sqlProps);
$stmtP->bind_param("i", $idAnnonce);
$stmtP->execute();
$propositions = $stmtP->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtP->close();
