<?php
    session_start();

    //Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['idUtilisateur'])) {
        header("Location: login.inc.php");
        exit();
    }

    $idAnnonce = $_GET['ref'];

if(isset($idAnnonce)):
    try {
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM annonce a 
            JOIN client c ON c.idClient = a.idClient
            JOIN image i ON i.idAnnonce = a.idAnnonce 
            WHERE a.idAnnonce = :idAnnonce";
        $request = $bdd->prepare($sql);
        $request->bindParam(':idAnnonce', $idAnnonce, PDO::PARAM_INT);
        $request->execute();
        $annonce = $request->fetch(PDO::FETCH_ASSOC);
        var_dump($annonce);
        
        //------------ Recup logement ville arrivée ------------------------
        $sql = "SELECT idAnnonce, ville as villeArrivee, etage, ascenceur FROM logement WHERE statut = :statut AND idAnnonce = :idAnnonce";
        $request = $bdd->prepare($sql);
        $statut = 'arrivee';
        $request->bindParam(':statut', $statut, PDO::PARAM_STR);
        $request->bindParam(':idAnnonce', $idAnnonce, PDO::PARAM_INT);
        $request->execute();
        $logementArrivee = $request->fetch(PDO::FETCH_ASSOC);
        var_dump($logementArrivee);

        //------------ Recup logement ville arrivée ------------------------
        $sql = "SELECT idAnnonce, ville as villeDepart, etage, ascenceur FROM logement WHERE statut = :statut AND idAnnonce = :idAnnonce";
        $request = $bdd->prepare($sql);
        $statut = 'depart';
        $request->bindParam(':statut', $statut, PDO::PARAM_STR);
        $request->bindParam(':idAnnonce', $idAnnonce, PDO::PARAM_INT);
        $request->execute();
        $logementDepart  = $request->fetch(PDO::FETCH_ASSOC);
        var_dump($logementDepart);

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
else:
    echo "Impossible de recupérer l'annonce a afficher";
endif;

    $title = 'Delais Annonce';
    include('header.inc.php');
    include('navbar.inc.php');
?>

<?php include('footer.inc.php'); ?>
