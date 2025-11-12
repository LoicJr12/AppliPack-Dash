<?php
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";  // Remplace par ton nom d'utilisateur MySQL
    $password = "root";      // Remplace par ton mot de passe MySQL
    $dbname = "pack&dash";  // Remplace par le nom de ta base de données

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    return $conn;
}
?>
