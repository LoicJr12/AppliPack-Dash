        <?php
            $title = 'Dashboard Demenageur';
            include('header.inc.php');
            include('navbar.inc.php');
            include('demenageur/search.demenageur.php');
        ?>
        <div class="col">
            <div>
                <?php
                    $lastName = 'Loïc :)';
                    include('demenageur/sidebar.demenageur.php');
                ?>
            </div>
            <div>
                <?php include('footer.inc.php');?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="styles/animation.menu.js"></script>
    </body>
</html>