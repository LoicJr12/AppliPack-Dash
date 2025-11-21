        <?php 
            session_start();
            $_SESSION = array();
            session_destroy();
    
            $title = "Deconnexion";
            include('header.inc.php')
        ?>
        <div class="container-fluid">
            <div class="d-flex flex-column p-5 min-vh-100 justify-content-center align-items-center">
                <div class="d-flex flex-row justify-content-center align-items-center gap-4 mb-3">
                    <h3>Déconnexion en cours...</h3>
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div>
                    <h3>Vous allez être redirigé vers la page de connexion. 🔐</h3>
                </div>
            </div>
        </div>
        <?php include('footer.inc.php');?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>
<?php
    header("Refresh: 2; URL=login.inc.php");
    exit();
?>