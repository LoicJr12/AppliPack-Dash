<form action="" method="get" class="new-proposition">
    <div class="head-form mb-3">
        <h3 class="title">Nouvelle Proposition</h3>
        <span class="text-body-secondary">Remplissez les champs ci dessous</span>
    </div>
    <div class="field">
        <div class="input-group mb-3">
            <label for="prixproposition" class="form-label">Prix</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="text" class="form-control" id="prixproposition" name="prix">
                <span class="input-group-text">.00</span>
            </div>
        </div>
        <div class="mb-3">
            <label for="messageInput" class="form-label">Message</label>
            <textarea class="form-control" id="messageInput" name="messagePropositions" rows="2"></textarea>
        </div>
        <div class="d-flex f-row buttonForm">
            <button type="submit" class="btn btn-primary">Soummettre</button> 
            <button type="reset" class="btn btn-danger">Renitialiser</button>
        </div>
    </div>
</form>