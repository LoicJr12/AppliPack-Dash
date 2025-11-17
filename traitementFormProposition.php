<?php
    session_start();
    
    //Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['idUtilisateur'])) {
        header("Location: login.inc.php");
        exit();
    }

    $idAnnonce = $_POST['idAnnonce'] ?? null;
    $prix = $_POST['prix'] ?? null;
    $messageProposition = $_POST['messagePropositions'] ?? null;
    //$idDemenageur = $_SESSION['idUtilisateur'] ?? 2;


    if (isset($idAnnonce) && isset($prix) && isset($messageProposition)) {
        try {
            $servername = 'localhost';
            $username = 'root';
            $password = 'root';
            $bdd = new PDO("mysql:host=$servername;dbname=packdash", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT idDemenageur FROM demenageur WHERE idUtilisateur = :idUtilisateur";
            $request = $bdd->prepare($sql);
            $request->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
            $request->execute();
            $utilisateur = $request->fetch(PDO::FETCH_ASSOC);
            if (isset($utilisateur)) {
                $idDemenageur = $utilisateur['idDemenageur'];
            }

            $sql = "INSERT INTO proposition (prixPropose, message, statut, idDemenageur, idAnnonce, date) 
                    VALUES (:prixPropose, :message, :statut, :idDemenageur, :idAnnonce, :date)";
            $request = $bdd->prepare($sql);
            $request->bindParam(':prixPropose', $prix);
            $request->bindParam(':message', $messageProposition);
            $statut = 'en attente';
            $request->bindParam(':statut', $statut);
            $request->bindParam(':idDemenageur', $idDemenageur); 
            $request->bindParam(':idAnnonce', $idAnnonce);
            $dateExacte = new DateTime();
            $date = $dateExacte->format('Y-m-d');
            $request->bindParam(':date', $date);
            $request->execute();

            header("Location: demenageur.inc.php?success=proposition_soumise");
            exit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();    
        }
    } else {
        echo "Tous les champs sont requis.";
    }
?>