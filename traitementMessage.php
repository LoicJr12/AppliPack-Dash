<?php
    session_start();
    
    //Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['idUtilisateur'])) {
        header("Location: login.inc.php");
        exit();
    }

    $recepteur = $_POST['recepteur'] ?? null;
    $contenu = $_POST['message'] ?? null;
    $emeteur = $_SESSION['idUtilisateur'] ?? null;
    //$idProposition = $_POST['proposition'] ?? null;


    if (isset($recepteur) && isset($contenu) && isset($emeteur)) {
        try {
            $servername = 'localhost';
            $username = 'root';
            $password = 'root';
            $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /*$sql = "SELECT idAnnonce FROM proposition WHERE idProposition = :idProposition";
            $request = $bdd->prepare($sql);
            $request->bindParam(':idProposition', $idProposition, PDO::PARAM_INT);
            $request->execute();
            $proposition = $request->fetch(PDO::FETCH_ASSOC);
            if (isset($proposition)) {
                $idAnnonce = $proposition['idAnnonce'];
            }
            $sql = "INSERT INTO message (idMessage, contenu, emeteur, recepteur, idAnnonce, date) 
                    VALUES (:idMessage, :contenu, :emeteur, :recepteur, :idAnnonce, :date)";
            $request->bindParam(':idAnnonce', $idAnnonce);
            */

            $sql = "INSERT INTO message (contenu, emeteur, recepteur, date) 
                    VALUES (:contenu, :emeteur, :recepteur, :date)";
            $request = $bdd->prepare($sql);
            $request->bindParam(':contenu', $contenu);
            $request->bindParam(':emeteur', $emeteur);
            $request->bindParam(':recepteur', $recepteur);
            $dateExacte = new DateTime();
            $date = $dateExacte->format('Y-m-d');
            $request->bindParam(':date', $date);
            $request->execute();

            header("Location: demenageur.inc.php?success=message_envoye");
            exit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();    
        }
    } else {
        echo "Données Manquantes pour l'envoie du message";
    }
?>