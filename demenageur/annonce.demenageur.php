<?php
    try {
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM annonce ORDER BY date_de_publication DESC";
        $request = $bdd->prepare($sql);
        $request->execute();
        $listAnnonce = array();
        while($annonce = $request->fetch(PDO::FETCH_ASSOC)){
            $listAnnonce[] = $annonce ;
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
?>

<div class="displayCard">
    <?php foreach($listAnnonce as $annonce) { ?>
        <div class="card mb-3 bg-light">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($annonce['titre']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($annonce['description']); ?></p>
                <p class="card-text"><strong>Nombre de demenageurs :</strong> <?php echo htmlspecialchars($annonce['nbreDemenageur']); ?></p>
                <p class="card-text"><strong>Surface :</strong> <?php echo htmlspecialchars($annonce['volumeTotal']); ?></p>
                <p class="card-text">
                    <strong>Date et heure du déménagement :</strong> 
                    <?php echo htmlspecialchars($annonce['date']).' à '.htmlspecialchars($annonce['heure']); ?>
                </p>
                <p class="card-text"><small class="text-muted">Publié le : <?php echo htmlspecialchars($annonce['date_de_publication']); ?></small></p>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    Faire une proposition 📝
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