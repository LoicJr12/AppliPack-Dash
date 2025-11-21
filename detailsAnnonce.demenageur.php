<?php
    session_start();

    //Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['idUtilisateur'])) {
        header("Location: login.inc.php");
        exit();
    }

    $idAnnonce = $_GET['ref'] ?? null;

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
        
        
        //------------ Recup logement ville arrivée ------------------------
        $sql = "SELECT idAnnonce, ville as villeArrivee, etage, ascenceur, type FROM logement WHERE statut = :statut AND idAnnonce = :idAnnonce";
        $request = $bdd->prepare($sql);
        $statut = 'arrivee';
        $request->bindParam(':statut', $statut, PDO::PARAM_STR);
        $request->bindParam(':idAnnonce', $idAnnonce, PDO::PARAM_INT);
        $request->execute();
        $logementArrivee = $request->fetch(PDO::FETCH_ASSOC);

        //------------ Recup logement ville arrivée ------------------------
        $sql = "SELECT idAnnonce, ville as villeDepart, etage, ascenceur, type FROM logement WHERE statut = :statut AND idAnnonce = :idAnnonce";
        $request = $bdd->prepare($sql);
        $statut = 'depart';
        $request->bindParam(':statut', $statut, PDO::PARAM_STR);
        $request->bindParam(':idAnnonce', $idAnnonce, PDO::PARAM_INT);
        $request->execute();
        $logementDepart  = $request->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
else:
    echo "Impossible de recupérer l'annonce a afficher";
endif;

    $title = 'Details Annonce';
    include('header.inc.php');
    include('navbar.inc.php');
?>
<main>
    <div class="container-fluid p-5">
        <div class="d-flex flex-col mb-3">
            <a href="demenageur.inc.php" class="btn btn-primary text-white"><i class="fa-solid fa-arrow-left" ></i>Retour</a>
        </div>
        <div class="card w-100 bg-light">
            <div class="card-title d-flex flex-row bg-primary text-white justify-content-center align-items-center rounded-top p-2">
                <h3><?php echo htmlspecialchars($annonce['titre']); ?></h3>
            </div>
            <div class="card-body p-2">
                <p class="card-text"><?php echo $annonce['description']; ?></p>
                <div class="d-flex flex-row gap-5">
                    <p class="card-text"><strong>Nombre de demenageurs :</strong> <?php echo htmlspecialchars($annonce['nbreDemenageur']); ?></p>
                    <p class="card-text"><strong>Surface :</strong> <?php echo htmlspecialchars($annonce['volumeTotal']); ?> m²</p>
                </div>
                <div class="card-text d-flex flex-row gap-5 mb-3">
                    <div class="card-text infosVilleDepart">
                        <h5>Depart</h5>
                        <p class="card-text"><strong>Ville Depart :</strong> <?php echo htmlspecialchars($logementDepart['villeDepart']); ?></p>
                        <p class="card-text"><strong>Type :</strong> <?php echo htmlspecialchars($logementDepart['type']); ?></p>
                        <?php if($logementDepart['etage'] != 0):?>
                            <p class="card-text"><strong>A l'etage :</strong> <?php echo htmlspecialchars($logementDepart['etage']); ?></p>
                        <?php else:?>
                            <p class="card-text"><strong>A l'etage :</strong> Non</p>
                        <?php endif;?>
                        <?php if($logementDepart['ascenceur'] === 0):?>
                            <p class="card-text"><strong>Ascenceur :</strong> Non </p>
                        <?php else:?>
                            <p class="card-text"><strong>Ascenceur :</strong> Oui </p>
                        <?php endif;?>
                    </div>
                    <div class="card-text infosVilleArrivee">
                        <h5>Arrivee</h5>
                        <p class="card-text"><strong>Ville Arrivee :</strong> <?php echo htmlspecialchars($logementArrivee['villeArrivee']); ?></p>
                        <p class="card-text"><strong>Type :</strong> <?php echo htmlspecialchars($logementArrivee['type']); ?></p>
                        <?php if($logementArrivee['etage'] != 0):?>
                            <p class="card-text"><strong>A l'etage :</strong> <?php echo htmlspecialchars($logementArrivee['etage']); ?></p>
                        <?php else:?>
                            <p class="card-text"><strong>A l'etage :</strong> Non</p>
                        <?php endif;?>
                        <?php if($logementArrivee['ascenceur'] == 0):?>
                            <p class="card-text"><strong>Ascenceur :</strong> Non </p>
                        <?php else:?>
                            <p class="card-text"><strong>Ascenceur :</strong> Oui </p>
                        <?php endif;?>
                    </div>
                    
                </div>
                <div class="card-text d-flex flex-row gap-5">
                    <p class="card-text">
                        <strong>Date du déménagement :</strong> 
                        <?php echo htmlspecialchars($annonce['date']); ?>
                    </p>
                    <p class="card-text">
                        <strong>Heure du déménagement :</strong> 
                        <?php echo htmlspecialchars($annonce['heure']); ?>
                    </p>
                </div>
                <div class="d-flex flex-row gap-5">
                    <p class="card-text"><strong>Client 🪪:</strong> <?php echo htmlspecialchars($annonce['prenom']).' '.htmlspecialchars($annonce['nom']); ?></p>
                    <p class="card-text"><strong>Contact 📞:</strong> <?php echo htmlspecialchars($annonce['contact']); ?></p>
                </div>
                <p class="card-text"><small class="text-muted">Publié le : <?php echo htmlspecialchars($annonce['date_de_publication']); ?></small></p>
            </div>
            <?php if(isset($annonce['url'])):?>
                <img src="<?php echo $annonce['url']; ?>" class="card-img-bottom" alt="photo maison">
            <?php else:?>
                <img src="" class="card-img-bottom" alt="photo maison">
            <?php endif;?>
        </div>
    </div>
</main>
<?php include('footer.inc.php'); ?>
