/*--------------------Animation Message--------------------*/
const fenetreMessage = document.getElementById('exampleModal')
if (fenetreMessage) {
    fenetreMessage.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = fenetreMessage.querySelector('.modal-title')
    const modalBodyInput = fenetreMessage.querySelector('.modal-body input')

    modalTitle.textContent = `New message to ${recipient}`
    modalBodyInput.value = recipient
    })
}
/*----------------------------------------------------------*/

/*------------------- Animation voir details ----------------*/
const fenetreDetailsAnnonce = document.getElementById('exampleModal1')
if (fenetreDetailsAnnonce) {
    fenetreDetailsAnnonce.addEventListener('show.bs.modal', event => {
        const buttonDetails = event.relatedTarget
        const valeur = buttonDetails.getAttribute('data-id')
        const modalBodyInput = fenetreDetailsAnnonce.querySelector('.modal-body .idAnnonceDetails')
        // Update the modal's content.
        const modalTitle = fenetreDetailsAnnonce.querySelector('.modal-title1')
        modalTitle.textContent = `Details anonnce #REF-ID${valeur}`
        modalBodyInput.value = valeur
        window.location.href = 'demenageur.inc.php?refDetails=' + valeur;
    })
}
/*-----------------------------------------------------------*/
/*fetch("getAnnonceDetails.php?refDetails=" + encodeURIComponent(valeur))
            .then(res => res.text())
            .catch(err => console.error("Erreur fetch :", err));*/


/*--------Recuperation id Proposition pour annonce------------*/
document.querySelectorAll('.faire-proposition').forEach( btn => {
    btn.addEventListener('click', () => {
        const idAnnonce = btn.getAttribute('data-id');
        document.getElementById('idAnnonceField').value = idAnnonce;
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


/*****CHANGEMENT DE DISPOSTION PAR SIDEBAR LINK ****************/
const linkDashboard = document.querySelector('.dashboard')
const linkNewAnnonce = document.querySelector('.newAnnonce')
const linkMesPropositions = document.querySelector('.mesPropositions')

const sectionAnnonce = document.querySelector('.annonces-section');
const sectionProposition = document.querySelector('.proposition-section');
const displayCard = document.querySelector('.displayCard');
const card = document.querySelector('.card ');


if(linkDashboard){
    linkNewAnnonce.addEventListener('click', () => {
        sectionProposition.classList.toggle('d-none');
        console.log(sectionProposition);
        sectionAnnonce.classList.toggle('col-md-8');
        console.log(sectionAnnonce);
        displayCard.classList.toggle('row gap-2');
        console.log(displayCard);
        card.classList.toggle('col-5')
        console.log(card);
    });
}
/*------------------------------------------------------------*/
