<?php
    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['idUtilisateur'])) {
        header("Location: login.inc.php");
        exit();
    }

    $idProposition = $_GET['id'] ?? null;

    if (isset($idProposition)) {
        try {
            $servername = 'localhost';
            $username = 'root';         
            $password = 'root';
            $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "SELECT idDemenageur FROM demenageur WHERE idUtilisateur = :idUtilisateur";
            $request = $bdd->prepare($sql);
            $request->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
            $request->execute();
            $utilisateur = $request->fetch(PDO::FETCH_ASSOC);
            if (isset($utilisateur)) {
                $idDemenageur = $utilisateur['idDemenageur'];
            }

            $sql = "DELETE FROM proposition WHERE idProposition = :idProposition AND idDemenageur = :idDemenageur";
            $request = $bdd->prepare($sql);
            $request->bindParam(':idProposition', $idProposition, PDO::PARAM_INT);
            $request->bindParam(':idDemenageur', $idDemenageur, PDO::PARAM_INT);
            $request->execute();
            $resultat = $request->rowCount();
            if ($resultat === 0) {
                header("Location: demenageur.inc.php?erreur=proposition_nonannulee");
                exit();
            }else {
                header("Location: demenageur.inc.php?success=proposition_annulee");
                exit();
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la proposition : " . $e->getMessage();
        }
    } else {
        echo "ID de proposition manquant.";
    }
?>