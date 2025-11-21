        <?php
            session_start(); // Démarrer la session

            try {
                $servername = 'localhost';
                $username = 'root';
                $password = 'root';
                $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    if(!empty($email) && !empty($password)) {
                        $sql = "SELECT * FROM utilisateur WHERE email= :email";
                        $request = $bdd->prepare($sql);
                        $request->execute(array("email" => $email));
                        $user = $request->fetch();

                        if($user && password_verify($password, $user['password'])) {
                            // Stocker les informations de l'utilisateur dans la session
                            $_SESSION['idUtilisateur'] = $user['idUtilisateur'];
                            $_SESSION['userName'] = $user['userName'];
                            $_SESSION['type'] = $user['type'];
                        } else {
                            header("Location: login.inc.php?error=1");
                            exit();
                        }
                    } else {
                        header("Location: login.inc.php?error=2");
                        exit();
                    }
                }
            } catch (PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
            }

            $title = "Redirection";
            include('header.inc.php')
        ?>
        <div class="container-fluid">
            <div class="d-flex flex-column p-5 min-vh-100 justify-content-center align-items-center">
                <div class="d-flex flex-row justify-content-center align-items-center gap-4 mb-3">
                    <h3>Connexion en cours...</h3>
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div>
                    <h3>Vous allez être redirigé vers votre espace utilisateur. 👨‍💻👩‍💻</h3>
                </div>
            </div>
        </div>
        <?php include('footer.inc.php');?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>
<?php
    if($user['type'] == 'client') {
        header("Refresh: 2; URL=customerPage.php");
    } else {
        header("Refresh: 2; URL=demenageur.inc.php");
    }
    exit();
?>
