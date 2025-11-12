<?php
//session_start();

//if (!isset($_SESSION['idUtilisateur'])) {
   // header("Location: login.php");
   // exit();
//}

//include ('bdd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $villeDepart = $_POST['villeDepart'];
    $adresseDepart = $_POST['adresseDepart'];
    $villeArrivee = $_POST['villeArrivee'];
    $adresseArrivee = $_POST['adresseArrivee'];
    $typeLogement = $_POST['typeLogement'];
    $volume = $_POST['volume'];
    $nbreDemenageur = $_POST['nbreDemenageur'];
    $description = $_POST['description'];
    $idClient = $_SESSION['idUtilisateur'];

    $conn = connectToDatabase();

    $sql = "INSERT INTO Annonce (titre, date, heure, villeDepart, adresseDepart, villeArrivee, adresseArrivee, typeLogement, volumeTotal, nbreDemenageur, description, idClient)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssdisi", $titre, $date, $heure, $villeDepart, $adresseDepart, $villeArrivee, $adresseArrivee, $typeLogement, $volume, $nbreDemenageur, $description, $idClient);

    if ($stmt->execute()) {
        header("Location: customerPage.php");
        exit();
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
    <?php
    $title = 'newAnnonce.php';
    include 'header.inc.php'; 
    include 'newAnnonce.inc.php';
    include 'footer.inc.php'; 
    ?>
    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
