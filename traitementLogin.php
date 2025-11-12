<?php
    try{
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!empty($email) && !empty($password) ){
                $sql = "SELECT * FROM utilisateur WHERE email= :email";
                //$sql = "SELECT * FROM utilisateur WHERE email= :email AND password= :password";
                $request = $bdd->prepare($sql);
                $request->execute(
                    array(
                        "email" => "$email"
                        //"password" => "$password"
                    )
                );
                $user = $request->fetch();
                //$reponse = $request->fetch();
                if($user && $user['password'] == $password){
                    if($user['type'] == 'client'){
                        header("Location: customerPage.php");
                    }else{
                        header("Location: index.php");
                    }
                    exit();
                }else{
                    header("Location: login.inc.php?error=1");
                    exit();
                }
            }else{
                header("Location: login.inc.php?error=2");
                exit();
            }
        }
    }catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
?>