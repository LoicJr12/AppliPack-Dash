<?php

    try {
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM annonce a JOIN client c ON c.idClient = a.idClient ORDER BY date_de_publication DESC";
        $request = $bdd->prepare($sql);
        $request->execute();
        $listAnnonce = array();
        while($annonce = $request->fetch(PDO::FETCH_ASSOC)){
            $listAnnonce[] = $annonce ;
        }
        
        //------------ Recup logement ville arrivée ------------------------
        $sql = "SELECT idAnnonce, ville as villeArrivee FROM logement WHERE statut = :statut";
        $request = $bdd->prepare($sql);
        $statut = 'arrivee';
        $request->bindParam(':statut', $statut, PDO::PARAM_STR);
        $request->execute();
        $listLogemementArrivee = array();
        while($logementArrivee = $request->fetch(PDO::FETCH_ASSOC)){
            $listLogemementArrivee[] = $logementArrivee ;
        }

        //------------ Recup logement ville arrivée ------------------------
        $sql = "SELECT idAnnonce, ville as villeDepart FROM logement WHERE statut = :statut";
        $request = $bdd->prepare($sql);
        $statut = 'depart';
        $request->bindParam(':statut', $statut, PDO::PARAM_STR);
        $request->execute();
        $listLogemementDepart = array();
        while($logementDepart  = $request->fetch(PDO::FETCH_ASSOC)){
            $listLogemementDepart[] = $logementDepart ;
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
?>

<div class="displayCard displayCardAnnonce">
    <?php foreach($listAnnonce as $annonce) { ?>
        <div class="card mb-3 bg-light cardAnnonce">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($annonce['titre']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($annonce['description']); ?></p>
                <div class="d-flex flex-row gap-3">
                    <p class="card-text"><strong>Nombre de demenageurs :</strong> <?php echo htmlspecialchars($annonce['nbreDemenageur']); ?></p>
                    <p class="card-text"><strong>Surface :</strong> <?php echo htmlspecialchars($annonce['volumeTotal']); ?> m²</p>
                </div>
                <div class="d-flex flex-row gap-3">
                    <?php 
                        foreach($listLogemementDepart as $logementDepart) :
                            if($logementDepart['idAnnonce'] === $annonce['idAnnonce']):
                    ?>
                        <p class="card-text"><strong>Depart :</strong> <?php echo htmlspecialchars($logementDepart['villeDepart']); ?></p>
                    <?php endif ;
                        endforeach; 
                    ?>
                    <?php 
                        foreach($listLogemementArrivee as $logementArrivee) :
                            if($logementArrivee['idAnnonce'] === $annonce['idAnnonce']):
                    ?>
                        <p class="card-text"><strong>Arrivee :</strong> <?php echo htmlspecialchars($logementArrivee['villeArrivee']); ?></p>
                    <?php endif ;
                        endforeach; 
                    ?>
                </div>
                <p class="card-text">
                    <strong>Date et heure du déménagement :</strong> 
                    <?php echo htmlspecialchars($annonce['date']).' à '.htmlspecialchars($annonce['heure']); ?>
                </p>
                <p class="card-text"><small class="text-muted">Publié le : <?php echo htmlspecialchars($annonce['date_de_publication']); ?></small></p>
                <button class="btn btn-success faire-proposition" type="button" data-bs-toggle="offcanvas" 
                    data-id="<?php echo $annonce['idAnnonce']; ?>" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    Faire une proposition 📝
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1" 
                    data-id="<?php echo htmlspecialchars($annonce['idAnnonce']); ?>">
                    voir details
                </button>
            </div>
        </div>
    <?php } ?>
</div>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="staticBackdropLabel">Nouvelle Proposition</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="mb-2">
        <strong>Alors <?php echo htmlspecialchars($lastName); ?> 💁‍♂️</strong>
        <p>Que proposez vous ? Le client n'attend plus que vous. ⏳</p>
    </div>
    <div>
        <?php include('formProposition.inc.php'); ?>
    </div>
  </div>
</div>

<!-- Modal -->
 <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-light">
      <div class="modal-header">
        <h1 class="modal-title1 fs-5" id="exampleModalLabel1">Details de l'annonce</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control idAnnonceDetails" id="recipient-name" value="">
        <?php
            $idAnnonceRecuperer = $_GET['refDetails'];
            if(isset($idAnnonceRecuperer)) :
                foreach($listAnnonce as $annonce):
                    if($annonce['idAnnonce'] === $idAnnonceRecuperer): 
        ?>
            <div class="card mb-3 bg-light">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($annonce['titre']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($annonce['description']); ?></p>
                    <div class="d-flex flex-row gap-3">
                        <p class="card-text"><strong>Nombre de demenageurs :</strong> <?php echo htmlspecialchars($annonce['nbreDemenageur']); ?></p>
                        <p class="card-text"><strong>Surface :</strong> <?php echo htmlspecialchars($annonce['volumeTotal']); ?> m²</p>
                    </div>
                    <div class="d-flex flex-row gap-3">
                        <?php 
                            foreach($listLogemementDepart as $logementDepart) :
                                if($logementDepart['idAnnonce'] === $annonce['idAnnonce']):
                        ?>
                            <p class="card-text"><strong>Depart :</strong> <?php echo htmlspecialchars($logementDepart['villeDepart']); ?></p>
                        <?php endif ;
                            endforeach; 
                        ?>
                        <?php 
                            foreach($listLogemementArrivee as $logementArrivee) :
                                if($logementArrivee['idAnnonce'] === $annonce['idAnnonce']):
                        ?>
                            <p class="card-text"><strong>Arrivee :</strong> <?php echo htmlspecialchars($logementArrivee['villeArrivee']); ?></p>
                        <?php endif ;
                            endforeach; 
                        ?>
                    </div>
                    <p class="card-text">
                        <strong>Date et heure du déménagement :</strong> 
                        <?php echo htmlspecialchars($annonce['date']).' à '.htmlspecialchars($annonce['heure']); ?>
                    </p>
                    <p class="card-text"><small class="text-muted">Publié le : <?php echo htmlspecialchars($annonce['date_de_publication']); ?></small></p>
                </div>
            </div>
        <?php 
                    endif;
                endforeach; 
            endif;
        ?>
      </div>
    </div>
  </div>
</div>
