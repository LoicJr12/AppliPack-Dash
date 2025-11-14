<?php
    session_start();

    try {
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM annonce";
        $request = $bdd->prepare($sql);
        $request->execute();
        while($annonce = $request->fetch(PDO::FETCH_ASSOC)){
            $listAnnoce[] = $annonce ;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    
?>