/*--------------------Animation Message--------------------*/
const fenetreMessage = document.getElementById('exampleModal');
if (fenetreMessage) {
    fenetreMessage.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-id')
    const user = button.getAttribute('data-bs-whatever')
    const idPropositionHidden = button.closest('.card-body').querySelector('input').value;
    console.log(idPropositionHidden);
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = fenetreMessage.querySelector('.modal-title')
    const modalBodyDestinataire = fenetreMessage.querySelector('.modal-body input')
    const modalBodyDestinateur = fenetreMessage.querySelector('.modal-body .idPropositionHidden')

    modalTitle.textContent = `New message to ${user}`
    modalBodyDestinataire.value = recipient
    modalBodyDestinateur.value = idPropositionHidden
    })
}
/*----------------------------------------------------------*/

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

/***************CHANGEMENT DISPOSITION BAY NAVBARINC *******************/
const iconRocket = document.querySelector('.rocket')
const iconInbox = document.querySelector('.inbox')

if(iconRocket){
    iconRocket.addEventListener('click', () => {
        if(sectionProposition.classList.contains('col-md-9') === true){
            sectionProposition.classList.toggle('d-none');
            sectionProposition.classList.toggle('col-md-9');
            displayCardProposition.classList.toggle('row');
            displayCardProposition.classList.toggle('gap-5');
            cardProposition.forEach( card => {
                card.classList.toggle('col-5');
            });
        }else{
            sectionProposition.classList.toggle('d-none');
        }

        if(sectionAnnonce.classList.contains('d-none') === true){
            sectionAnnonce.classList.remove('d-none');
            sectionAnnonce.classList.toggle('col-md-9');
        }else{
            sectionAnnonce.classList.toggle('col-md-9');
        }

        displayCardAnnonce.classList.toggle('row');
        displayCardAnnonce.classList.toggle('gap-5');
        cardAnnonce.forEach( card => {
            card.classList.toggle('col-5');
        });
    });
}

if(iconInbox){
    iconInbox.addEventListener('click', () => {
        if(sectionAnnonce.classList.contains('col-md-9') === true){
            sectionAnnonce.classList.toggle('d-none');
            sectionAnnonce.classList.toggle('col-md-9');
            displayCardAnnonce.classList.toggle('row');
            displayCardAnnonce.classList.toggle('gap-5');
            cardAnnonce.forEach( card => {
                card.classList.toggle('col-5');
            });
        }else{
            sectionAnnonce.classList.toggle('d-none');
        }
        
        if(sectionProposition.classList.contains('d-none') === true){
            sectionProposition.classList.remove('d-none');
            sectionProposition.classList.toggle('col-md-9');
        }else{
            sectionProposition.classList.toggle('col-md-9');
        }
        
        displayCardProposition.classList.toggle('row');
        displayCardProposition.classList.toggle('gap-5');
        cardProposition.forEach( card => {
            card.classList.toggle('col-5');
            card.classList.remove('w-90');
        });
    });
}

/*------------------------------------------------------------*/


/*****CHANGEMENT DE DISPOSTION PAR SIDEBAR LINK ****************/
const linkDashboard = document.querySelector('.dashboard')
const linkNewAnnonce = document.querySelector('.newAnnonce')
const linkMesPropositions = document.querySelector('.mesPropositions')

const sectionAnnonce = document.querySelector('.annonces-section');
const sectionProposition = document.querySelector('.proposition-section');
const displayCardAnnonce = document.querySelector('.displayCardAnnonce');
const cardAnnonce = document.querySelectorAll('.cardAnnonce');
const cardProposition = document.querySelectorAll('.cardProposition');
const displayCardProposition = document.querySelector('.displayCardProposition');

if(linkDashboard){
    linkDashboard.addEventListener('click', () => {
        if(sectionAnnonce.classList.contains('d-none') === true){
            sectionAnnonce.classList.remove('d-none');
        }

        if(sectionProposition.classList.contains('d-none') === true){
            sectionProposition.classList.remove('d-none');
        }
        
        if(sectionAnnonce.classList.contains('col-md-9') === true){
            sectionAnnonce.classList.toggle('col-md-9');
            displayCardAnnonce.classList.toggle('row');
            displayCardAnnonce.classList.toggle('gap-5');
            cardAnnonce.forEach( card => {
                card.classList.toggle('col-5');
            });
        }

        if(sectionProposition.classList.contains('col-md-9') === true){
            sectionProposition.classList.toggle('col-md-9');
            displayCardProposition.classList.toggle('row');
            displayCardProposition.classList.toggle('gap-5');
            cardProposition.forEach( card => {
                card.classList.add('w-90');
                card.classList.toggle('col-5');
            });
        }
    });
}

if(linkNewAnnonce){
    linkNewAnnonce.addEventListener('click', () => {
        if(sectionProposition.classList.contains('col-md-9') === true){
            sectionProposition.classList.toggle('d-none');
            sectionProposition.classList.toggle('col-md-9');
            displayCardProposition.classList.toggle('row');
            displayCardProposition.classList.toggle('gap-5');
            cardProposition.forEach( card => {
                card.classList.toggle('col-5');
            });
        }else{
            sectionProposition.classList.toggle('d-none');
        }

        if(sectionAnnonce.classList.contains('d-none') === true){
            sectionAnnonce.classList.remove('d-none');
            sectionAnnonce.classList.toggle('col-md-9');
        }else{
            sectionAnnonce.classList.toggle('col-md-9');
        }

        displayCardAnnonce.classList.toggle('row');
        displayCardAnnonce.classList.toggle('gap-5');
        cardAnnonce.forEach( card => {
            card.classList.toggle('col-5');
        });
    });
}

if(linkMesPropositions){
    linkMesPropositions.addEventListener('click', () => {
        if(sectionAnnonce.classList.contains('col-md-9') === true){
            sectionAnnonce.classList.toggle('d-none');
            sectionAnnonce.classList.toggle('col-md-9');
            displayCardAnnonce.classList.toggle('row');
            displayCardAnnonce.classList.toggle('gap-5');
            cardAnnonce.forEach( card => {
                card.classList.toggle('col-5');
            });
        }else{
            sectionAnnonce.classList.toggle('d-none');
        }
        
        if(sectionProposition.classList.contains('d-none') === true){
            sectionProposition.classList.remove('d-none');
            sectionProposition.classList.toggle('col-md-9');
        }else{
            sectionProposition.classList.toggle('col-md-9');
        }
        
        displayCardProposition.classList.toggle('row');
        displayCardProposition.classList.toggle('gap-5');
        cardProposition.forEach( card => {
            card.classList.toggle('col-5');
            card.classList.remove('w-90');
        });
    });
}

/*------------------------------------------------------------*/
