        <?php
            $title = 'Login Page';
            include('header.inc.php');
            if (isset($_GET['error']) && $_GET['error'] == 1){
                $codErreur=1;
                include('formLogin.inc.php');
            }elseif (isset($_GET['error']) && $_GET['error'] == 2) {
                $codErreur=2;
                include('formLogin.inc.php');
            }else{
                $codErreur=0;
                include('formLogin.inc.php');
            }
            include('footer.inc.php');
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>