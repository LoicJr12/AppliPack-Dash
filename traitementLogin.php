<?php
session_start(); // Démarrer la session

try {
    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $bdd = new PDO("mysql:host=$servername;dbname=bdd_7_11", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password)) {
            $sql = "SELECT * FROM utilisateur WHERE email= :email";
            $request = $bdd->prepare($sql);
            $request->execute(array("email" => $email));
            $user = $request->fetch();

            if($user && $user['password'] == $password) {
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['idUtilisateur'] = $user['idUtilisateur'];
                $_SESSION['userName'] = $user['userName'];
                $_SESSION['type'] = $user['type'];

                if($user['type'] == 'client') {
                    header("Location: customerPage.php");
                } else {
                    header("Location: demenageur.inc.php");
                }
                exit();
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
?>
