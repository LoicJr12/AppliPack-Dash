<?php
    session_start();

    try {
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $bdd = new PDO("mysql:host=$servername;dbname=pack&dash", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM annonce ORDER BY date_de_publication DESC";
        $request = $bdd->prepare($sql);
        $request->execute();
        $listAnnonce = array();
        while($annonce = $request->fetch(PDO::FETCH_ASSOC)){
            $listAnnonce[] = $annonce ;
        }

        // Affichage des annonces triées
        foreach ($listAnnonce as $annonce) {
            echo $annonce['idAnnonce'] . ' - ' . $annonce['titre'] . ' - ' . $annonce['date_de_publication'] . '<br>';
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    
?>