<?php
// Inclure le fichier de connexion à la base de données
include 'bdd.php';

// Vérifier si l'ID de l'image est passé dans l'URL
if (!isset($_GET['id'])) {
    die("ID de l'image non spécifié.");
}

$idImage = $_GET['id'];

// Connexion à la base de données pour récupérer l'URL de l'image
$conn = connectToDatabase();
$sql = "SELECT url FROM Image WHERE idImage = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idImage);
$stmt->execute();
$result = $stmt->get_result();
$image = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$image) {
    die("Image non trouvée.");
}

$filePath = $image['url'];

// Vérifier si le fichier existe
if (!file_exists($filePath)) {
    die("Fichier non trouvé.");
}

// Récupérer le nom du fichier à partir du chemin
$fileName = basename($filePath);

// Définir les en-têtes pour le téléchargement
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;
?>
