<?php
    try {
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = " SELECT p.*, a.idAnnonce, c.nom AS client_nom, c.prenom AS client_prenom, c.contact
                FROM proposition p JOIN annonce a ON p.idAnnonce = a.idAnnonce
                JOIN client c ON a.idClient = c.idClient 
                ORDER BY p.date DESC";
        $request = $bdd->prepare($sql);
        $request->execute();
        $listeProposition = array();
        while($proposition = $request->fetch(PDO::FETCH_ASSOC)){
            $listeProposition[] = $proposition ;
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
?>


<?php foreach($listeProposition as $proposition) { ?>
    <div class="card mb-3 w-90 bg-light">
        <div class="card-body">
            <p class="card-text"><strong>Client 🪪:</strong> <?php echo htmlspecialchars($proposition['client_prenom'].' '.$proposition['client_nom']); ?></p>
            <p class="card-text"><strong>Contact 📞:</strong> <?php echo htmlspecialchars($proposition['contact']); ?></p>
            <p class="card-text"><strong>Prix proposé 💵:</strong> <?php echo htmlspecialchars($proposition['prixPropose']); ?> €</p>
            <p class="card-text"><strong>Statut :</strong>
                <?php if($proposition['statut'] === 'en attente') { ?>
                    <span class="badge text-bg-warning"><?php echo htmlspecialchars($proposition['statut']); ?></span>
                <?php } elseif($proposition['statut'] === 'Acceptée') { ?>
                    <span class="badge text-bg-success"><?php echo htmlspecialchars($proposition['statut']); ?></span>
                <?php } elseif($proposition['statut'] === 'Refusée') { ?>
                    <span class="badge text-bg-danger"><?php echo htmlspecialchars($proposition['statut']); ?></span>
                <?php } ?>
            </p>
            <p class="card-text"><small class="text-muted">Fait le : <?php echo htmlspecialchars($proposition['date']); ?></small></p>
            <div class="d-flex f-row buttonForm">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                    data-bs-whatever="<?php echo htmlspecialchars($proposition['client_prenom'].' '.$proposition['client_nom']); ?>">
                    contactez le 📱
                </button>
                <button type="button" class="btn btn-danger">Annuler ❌</button>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Destinataire :</label>
            <input type="text" class="form-control" id="recipient-name" readonly>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">quiter</button>
        <button type="button" class="btn btn-primary">envoyer le message</button>
      </div>
    </div>
  </div>
</div>

<script>
    const exampleModal = document.getElementById('exampleModal')
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an Ajax request here
        // and then do the updating in a callback.

        // Update the modal's content.
        const modalTitle = exampleModal.querySelector('.modal-title')
        const modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalTitle.textContent = `New message to ${recipient}`
        modalBodyInput.value = recipient
    })
}
</script>