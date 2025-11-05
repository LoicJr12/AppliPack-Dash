<?php
    try{
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $bdd = new PDO("mysql:host=$servername;dbname=bdtestpackdash", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!empty($email) && !empty($password) ){
                $sql = "SELECT * FROM utilisateur WHERE email= :email AND password= :password";
                $request = $bdd->prepare($sql);
                $request->execute(
                    array(
                        "email" => "$email",
                        "password" => "$password"
                    )
                );
                $reponse = $request->fetch();
                if($reponse['email'] == $email && $reponse['password'] == $password){
                    echo "connexion réussie 👌";
                    header("Location: index.php");
                }else{
                    echo "Email ou MDP incorect 🙅";
                    header("Location: formLogin.inc.php");
                }
            }else{
                echo "Fill form";
            }
        }
    }catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
?>