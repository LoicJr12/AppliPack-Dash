<?php
    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['idUtilisateur'])) {
        header("Location: login.inc.php");
        exit();
    }

    $idProposition = $_GET['idProposition'] ?? null;
    $idAnnonce = $_GET['idAnnonce'] ?? null;
    $idDemenageur = $_GET['id'] ?? null;

    if (isset($idProposition) && isset($idAnnonce) && isset($idDemenageur)) {
        try {
            $servername = 'localhost';
            $username = 'root';         
            $password = 'root';
            $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "UPDATE proposition SET statut = :statut
                WHERE idProposition = :idProposition AND idDemenageur = :idDemenageur AND idAnnonce = :idAnnonce";
            $request = $bdd->prepare($sql);
            $statut = 'refusee';
            $request->bindParam(':statut', $statut, PDO::PARAM_STR);
            $request->bindParam(':idProposition', $idProposition, PDO::PARAM_INT);
            $request->bindParam(':idDemenageur', $idDemenageur, PDO::PARAM_INT);
            $request->bindParam(':idAnnonce', $idAnnonce, PDO::PARAM_INT);
            $request->execute();
            $resultat = $request->rowCount();
            if ($resultat === 0) {
                header("Location: moverList.php?id=" . (int)$idAnnonce . "&erreur=proposition_non_refusee");
                exit();
            }else {
                header("Location: moverList.php?id=" . (int)$idAnnonce . "&success=proposition_refusee");
                exit();
            }
        } catch (PDOException $e) {
            echo "Erreur lors du refus de la proposition : " . $e->getMessage();
        }
    } else {
        echo "ID proposition ou ID annonce n'ont pas été recupérer.";
    }
?>