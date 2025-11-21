<?php
    //Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['idUtilisateur'])) {
        header("Location: login.inc.php");
        exit();
    }


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

        $sql2 = " SELECT p.*, a.idAnnonce, a.titre, c.idClient as client_id, c.nom AS client_nom, c.prenom AS client_prenom, c.contact
                FROM proposition p JOIN annonce a ON p.idAnnonce = a.idAnnonce
                JOIN client c ON a.idClient = c.idClient 
                WHERE p.idDemenageur = :idDemenageur
                ORDER BY p.date DESC";
        $request = $bdd->prepare($sql2);
        $request->bindParam(':idDemenageur', $idDemenageur, PDO::PARAM_INT);
        $request->execute();
        $listeProposition = array();
        while($proposition = $request->fetch(PDO::FETCH_ASSOC)){
            $listeProposition[] = $proposition ;
        }


    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
?>


<div class="displayCard displayCardProposition"> 
  <?php foreach($listeProposition as $proposition) { ?>
    <div class="card mb-3 w-90 bg-light cardProposition">
      <div class="card-body">
        <p class="card-text"><strong>Annonce : </strong><?php echo htmlspecialchars($proposition['titre']); ?></p>
        <div class="d-flex flex-row gap-3">
          <p class="card-text"><strong>Prix proposé 💵:</strong> <?php echo htmlspecialchars($proposition['prixPropose']); ?> €</p>
          <p class="card-text"><strong>Statut :</strong>
            <?php if($proposition['statut'] === 'en attente') { ?>
              <span class="badge text-bg-warning"><?php echo htmlspecialchars($proposition['statut']); ?></span>
            <?php } elseif($proposition['statut'] === 'acceptee') { ?>
              <span class="badge text-bg-success"><?php echo htmlspecialchars($proposition['statut']); ?></span>
            <?php } elseif($proposition['statut'] === 'refusee') { ?>
              <span class="badge text-bg-danger"><?php echo htmlspecialchars($proposition['statut']); ?></span>
            <?php } ?>
          </p>
        </div>
        <p class="card-text"><strong>Message :</strong> <?php echo htmlspecialchars($proposition['message']); ?></p>
        <div class="d-flex flex-row gap-3">
          <p class="card-text"><strong>Client 🪪:</strong> <?php echo htmlspecialchars($proposition['client_prenom']).' '.htmlspecialchars($proposition['client_nom']); ?></p>
          <p class="card-text"><strong>Contact 📞:</strong> <?php echo htmlspecialchars($proposition['contact']); ?></p>
        </div>
        <p class="card-text"><small class="text-muted">Fait le : <?php echo htmlspecialchars($proposition['date']); ?></small></p>
        <div class="d-flex f-row buttonForm">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" 
              data-bs-whatever="<?php echo htmlspecialchars($proposition['client_nom']); ?>"
              data-id="<?php echo htmlspecialchars($proposition['client_id']); ?>">
              contacter 💬
            </button>
            <input type="hidden" class="idPropositionHidden" value="<?php echo $proposition['idProposition']; ?>">
          <button type="button" class="btn btn-danger btn-annuler" data-id="<?php echo $proposition['idProposition']; ?>">Annuler ❌</button>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" readonly>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>