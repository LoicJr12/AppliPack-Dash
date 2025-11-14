        <?php
            session_start(); // Démarrer la session

            // Vérifier si l'utilisateur est connecté
            if (!isset($_SESSION['idUtilisateur'])) {
                header("Location: login.inc.php");
                exit();
            }

            $title = 'Dashboard Demenageur';
            include('header.inc.php');
            include('navbar.inc.php');
            include('demenageur/search.demenageur.php');
        ?>
        <div class="col">
            <div class="row">
                <div class="col-md-3">
                    <?php
                        $lastName = "Loïc :)";
                        if(isset($_SESSION['userName'])){
                            $lastName=$_SESSION['userName'];
                        }
                        include('demenageur/sidebar.demenageur.php');
                    ?>
                </div>
                <div class="col-md-9">
                    <?php include('formProposition.inc.php'); ?>
                </div>
            </div>
            <div>
                <?php include('footer.inc.php');?>
            </div>
        </div>
        <style>
            @media (max-width : 992px) {
                .col-md-3{
                    display: none;
                }
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="styles/animation.menu.js"></script>
    </body>
</html>