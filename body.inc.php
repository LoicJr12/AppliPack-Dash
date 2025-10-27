<div class="containeur-fluid main-content">
    <div class="row">
        <div class="col-lg-5 bloc-text">
            <p class="text-slogan">
                Chez <span class="title">Pack & Dash</span>,<br>
                Nous croyons que votre déménagement ne derait pas être une 
                source de stress et devrait se faire en toute sérénité.
                <span class="slogan">Vote déménagement notre priorité</span>.
            </p>
            <div class = "description">
                <h5 class="text">Comment ça marche</h5>
                <div class="instruction">
                    <span class="badge text-bg-primary border border-light rounded-circle">1</span>
                    Publier une annonce
                </div>
                <div class="instruction">
                    <span class="badge text-bg-primary border border-light rounded-circle">2</span>
                    Recever des propositions
                </div>
                <div class="instruction">
                    <span class="badge text-bg-primary border border-light rounded-circle">3</span>
                    Choisissez votre déménageur
                </div>
                <div class="instruction">
                    <span class="badge text-bg-primary border border-light rounded-circle">4</span>
                    Notez la prestation du déménageur
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="assets/image_body.png" class="d-block w-100" alt="img body 1">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="assets/image_body.png" class="d-block w-100" alt="img body 2">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="assets/image_body.png" class="d-block w-100" alt="img body 3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col avis-clients">
        <h5 class="text">Avis Clients</h5>
        <div class="row commentaires">
            <?php
                // Tableau contenant les données (images + commentaires)
                $cards = [
                    [
                        "image" => "assets/image_body.png",
                        "user" => "user-@1234",
                        "comment" => "je recommande à 100% 😍"
                    ],
                    [
                        "image" => "assets/image_body.png",
                        "user" => "user-@12345",
                        "comment" => "c'est le meilleur service de la terre 😆!"
                    ],
                    [
                        "image" => "assets/image_body.png",
                        "user" => "user-@123450",
                        "comment" => "Je suis ravie de les avoir connu trop top 😁"
                    ],
                    [
                        "image" => "assets/image_body.png",
                        "user" => "user-@123459",
                        "comment" => "En plus d'etre pas cher, ils sont pros 😉!"
                    ],
                    [
                        "image" => "assets/image_body.png",
                        "user" => "user-@123459",
                        "comment" => "Wesh, c'est trop un D leur entreprise. Chapeau🫠"
                    ]
                ];

                foreach ($cards as $card) {
                    echo '
                        <div class="card" style="width: 16rem;">
                            <img src="'.$card["image"].'" class="card-img-top" alt="img-profile">
                            <div class="card-body">
                                <h4 class="card-title">'.$card["user"].'</h4>
                                <p class="card-text">'.$card["comment"].'</p>
                            </div>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
</div>
