/*--------------------Animation Message--------------------*/
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
/*----------------------------------------------------------*/


/*--------Recuperation id Proposition pour annonce------------*/
document.querySelectorAll('.faire-proposition').forEach( btn => {
    btn.addEventListener('click', () => {
        const idAnnonce = btn.getAttribute('data-id');
        document.getElementById('idAnnonceField').value = idAnnonce;
        console.log('Annonce ID set to:', idAnnonce);
    });
});
/*------------------------------------------------------------*/

/*--------Recuperation id Proposition pour proposition------------*/
document.querySelectorAll('.btn-annuler').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.getAttribute('data-id');
        window.location.href = 'annulerProposition.inc.php?id=' + encodeURIComponent(id);
    });
  });
/*------------------------------------------------------------*/