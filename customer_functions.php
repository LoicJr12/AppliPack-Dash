<?php
include 'bdd.php';

function getCustomerInfo($idUtilisateur) {
    $conn = connectToDatabase();

    $sql = "SELECT u.userName, u.email, c.nom, c.prenom, c.contact
            FROM Utilisateur u
            JOIN Client c ON u.idUtilisateur = c.idUtilisateur
            WHERE u.idUtilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUtilisateur);
    $stmt->execute();
    $result = $stmt->get_result();

    $customerInfo = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $customerInfo;
}

function getCustomerAnnouncements($idUtilisateur) {
    $conn = connectToDatabase();

    $sql = "SELECT idAnnonce, titre, date, villeDepart, villeArrivee, statut FROM Annonce WHERE idClient = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUtilisateur);
    $stmt->execute();
    $result = $stmt->get_result();

    $announcements = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $announcements[] = $row;
        }
    }

    $stmt->close();
    $conn->close();

    return $announcements;
}
?>
