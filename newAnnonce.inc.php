<?php
// newAnnonce.inc.php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once 'bdd.php';

// Active les erreurs MySQLi (les prepare() qui échouent lèvent une exception)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$title  = "Créer une annonce - Pack & Dash";
$errors = [];
$success = false;

// 1) Sécurité : utilisateur connecté
if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.inc.php");
    exit();
}

$conn = connectToDatabase();
$conn->set_charset('utf8mb4');

$idUtilisateur = (int)$_SESSION['idUtilisateur'];

// 2) Récupérer l'idClient pour cet utilisateur
$sqlClient = "SELECT idClient FROM Client WHERE idUtilisateur = ?";
$stmtC = $conn->prepare($sqlClient);
$stmtC->bind_param("i", $idUtilisateur);
$stmtC->execute();
$rowC = $stmtC->get_result()->fetch_assoc();
$stmtC->close();

if (!$rowC) {
    header("Location: customerPage.php");
    exit();
}
$idClient = (int)$rowC['idClient'];

// 3) Traitement formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- Données Annonce ---
    $titre           = trim($_POST['titre'] ?? '');
    $description     = trim($_POST['description'] ?? '');
    $date            = $_POST['date'] ?? '';
    $heure           = $_POST['heure'] ?? '';
    $nbreDemenageur  = (int)($_POST['nbreDemenageur'] ?? 0);
    $volumeTotal     = (float)($_POST['volumeTotal'] ?? 0);
    $poidsTotal      = (float)($_POST['poidsTotal'] ?? 0);

    //------ date de publication j'ai rajouté ca a la table annonce et proposition (MODIF1) ------
    $dateExacte = new DateTime();
    $date_de_publication = $dateExacte->format('Y-m-d');
    //------------------------------------------------------------------------------------

    // --- Logement départ ---
    $ville_depart    = trim($_POST['ville_depart'] ?? '');
    $etage_depart    = (int)($_POST['etage_depart'] ?? 0);
    $asc_depart      = (($_POST['ascenseur_depart'] ?? '') === 'oui') ? 1 : 0;
    $statut_depart   = 'depart';
    $type_depart     = trim($_POST['type_depart_logement'] ?? 'non renseigne');

    // --- Logement arrivée ---
    $ville_arrivee   = trim($_POST['ville_arrivee'] ?? '');
    $etage_arrivee   = (int)($_POST['etage_arrivee'] ?? 0);
    $asc_arrivee     = (($_POST['ascenseur_arrivee'] ?? '') === 'oui') ? 1 : 0;
    $statut_arrivee  = 'arrivee';
    $type_arrivee    = trim($_POST['type_arrivee_logement'] ?? 'non renseigne');

    // --- Validations minimales ---
    if ($titre === '')               $errors[] = "Le titre est requis.";
    if ($date === '')                $errors[] = "La date est requise.";
    if ($heure === '')               $errors[] = "L'heure est requise.";
    if ($nbreDemenageur <= 0)        $errors[] = "Le nombre de déménageurs doit être > 0.";
    if ($volumeTotal <= 0)           $errors[] = "Le volume total doit être > 0.";
    if ($ville_depart === '')        $errors[] = "La ville de départ est requise.";
    if ($ville_arrivee === '')       $errors[] = "La ville d'arrivée est requise.";

    if (empty($errors)) {
        try {
            $conn->begin_transaction();

            // 3.1) INSERT Annonce  (backticks sur `date` et `heure`)
            // J'ai rajouté date_de_publication dans la requete aussi (MODIF 2)--------------------------
            $sqlA = "INSERT INTO Annonce
                     (titre, description, `date`, `heure`, nbreDemenageur, volumeTotal, poidsTotal, idClient, date_de_publication)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtA = $conn->prepare($sqlA);
            // // J'ai rajouté un S pour que la requete sur la date de plication marche (MODIF 2)--------------------------
            $stmtA->bind_param(
                "ssssiddis",
                $titre, $description, $date, $heure,
                $nbreDemenageur, $volumeTotal, $poidsTotal, $idClient, $date_de_publication
            );
            $stmtA->execute();
            $idAnnonce = $stmtA->insert_id;
            $stmtA->close();

            // 3.2) INSERT Logements (backticks sur `type`, colonne ascenceur = string 'oui'/'non')
            $sqlL = "INSERT INTO Logement (ville, etage, ascenceur, statut, `type`, idAnnonce)
                     VALUES (?, ?, ?, ?, ?, ?)";
            $stmtL = $conn->prepare($sqlL);

            // Départ
            $stmtL->bind_param(
                "siissi",
                $ville_depart, $etage_depart, $asc_depart,
                $statut_depart, $type_depart, $idAnnonce
            );
            $stmtL->execute();

            // Arrivée
            $stmtL->bind_param(
                "siissi",
                $ville_arrivee, $etage_arrivee, $asc_arrivee,
                $statut_arrivee, $type_arrivee, $idAnnonce
            );
            $stmtL->execute();
            $stmtL->close();

            // 3.3) Upload multi-images (facultatif)
            if (!empty($_FILES['images']) && is_array($_FILES['images']['name'])) {
                $allowedExt = ['jpg','jpeg','png','gif','webp'];
                $maxSize    = 5 * 1024 * 1024; // 5 Mo
                $destRoot   = __DIR__ . '/uploads/annonces/' . $idAnnonce;
                $publicRoot = 'uploads/annonces/' . $idAnnonce;

                if (!is_dir($destRoot)) {
                    mkdir($destRoot, 0775, true);
                }

                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $count = count($_FILES['images']['name']);
                for ($i = 0; $i < $count; $i++) {
                    $name    = $_FILES['images']['name'][$i];
                    $tmp     = $_FILES['images']['tmp_name'][$i];
                    $size    = (int)$_FILES['images']['size'][$i];
                    $err     = (int)$_FILES['images']['error'][$i];

                    if ($err === UPLOAD_ERR_NO_FILE) continue;
                    if ($err !== UPLOAD_ERR_OK) { $errors[] = "Upload échoué ($name) : code $err."; continue; }
                    if ($size <= 0 || $size > $maxSize) { $errors[] = "Fichier trop volumineux ($name)."; continue; }

                    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                    if (!in_array($ext, $allowedExt, true)) { $errors[] = "Extension non autorisée ($name)."; continue; }

                    $mime = $finfo->file($tmp);
                    if (strpos($mime, 'image/') !== 0) { $errors[] = "Fichier non image ($name)."; continue; }

                    $filename = bin2hex(random_bytes(8)) . '.' . $ext;
                    $destPath = $destRoot . '/' . $filename;
                    $urlRel   = $publicRoot . '/' . $filename;

                    if (!move_uploaded_file($tmp, $destPath)) { $errors[] = "Échec copie ($name)."; continue; }

                    $sqlImg = "INSERT INTO Image (url, idAnnonce) VALUES (?, ?)";
                    $stmtI  = $conn->prepare($sqlImg);
                    $stmtI->bind_param("si", $urlRel, $idAnnonce);
                    $stmtI->execute();
                    $stmtI->close();
                }
            }

            $conn->commit();
            $success = true;

            // Redirection après succès
            header("Location: customerPage.php");
            exit();

        } catch (Throwable $e) {
            // Toute erreur -> rollback + message clair
            $conn->rollback();
            $errors[] = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
}
