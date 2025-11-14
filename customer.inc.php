<?php
/**
 * Récupère les annonces d'un client donné.
 *
 * @param PDO $conn : Connexion à la base de données.
 * @param int $idClient : ID du client.
 * @return array : Tableau des annonces du client.
 */
function getCustomerAnnouncements(PDO $conn, int $idClient): array {
    try {
        $stmt = $conn->prepare("SELECT * FROM Annonce WHERE idClient = :idClient");
        $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération des annonces : " . $e->getMessage());
        return [];
    }
}

/**
 * Récupère les informations d'un client donné.
 *
 * @param PDO $conn : Connexion à la base de données.
 * @param int $idClient : ID du client.
 * @return array|null : Informations du client ou null si non trouvé.
 */
function getCustomerInfo(PDO $conn, int $idClient): ?array {
    try {
        $stmt = $conn->prepare("SELECT * FROM Client WHERE idClient = :idClient");
        $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération des informations du client : " . $e->getMessage());
        return null;
    }
}
?>
