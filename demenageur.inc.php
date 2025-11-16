        <?php
            //session_start();

            //Vérifier si l'utilisateur est connecté
            //if (!isset($_SESSION['idUtilisateur'])) {
            //    header("Location: login.inc.php");
            //    exit();
            //}

            $title = 'Dashboard Demenageur';
            include('header.inc.php');
            include('navbar.inc.php');
            include('demenageur/search.demenageur.php');
        ?>
        <div class="col-md-12 main-content">
            <div class="row gx-4">
                <div class="sidebar-section">
                    <?php
                        $lastName = "Loïc";
                        if(isset($_SESSION['userName'])){
                            $lastName=$_SESSION['userName'];
                        }
                        include('demenageur/sidebar.demenageur.php');
                    ?>
                </div>
                <div class="col-md-5 annonces-section">
                    <div class="mb-2 mt-2">
                        <h4>🚀 Nouvelles Annonces</h>
                    </div>
                    <?php include('demenageur/annonce.demenageur.php'); ?>
                </div>
                <div class="col-md-4 proposition-section">
                    <div class="mb-2 mt-2">
                        <h4>📋 Mes Propositions</h4>
                    </div>
                    <?php include('listeProposition.inc.php'); ?>
                </div>
            </div>
            <div>
                <?php include('footer.inc.php');?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="styles/animation.menu.js"></script>
        <script src="styles/animation.message.js"></script>
    </body>
</html>