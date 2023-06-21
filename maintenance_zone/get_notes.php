<?php
session_start();
require '../inc/pdo.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    echo "Vous devez être connecté pour accéder à cette page.";
    exit;
}

// Récupérer l'ID de la maintenance à partir des paramètres de l'URL
if (isset($_GET['maintenance_id'])) {
    $maintenanceId = $_GET['maintenance_id'];
} else {
    echo "ID de la maintenance non spécifié.";
    exit;
}

// Requête pour récupérer toutes les notes pour la maintenance spécifiée
$notesQuery = "SELECT * FROM maintenance_note WHERE maintenance_id = :maintenance_id";
$notesStmt = $website_pdo->prepare($notesQuery);
$notesStmt->bindParam(':maintenance_id', $maintenanceId, PDO::PARAM_INT);
$notesStmt->execute();
$notes = $notesStmt->fetchAll(PDO::FETCH_ASSOC);

// Construction du contenu HTML des notes
$html = '';
if (count($notes) > 0) {
    $html .= "<h2>Notes pour la maintenance ID : " . $maintenanceId . "</h2>";
    foreach ($notes as $note) {
        $html .= "<p>Note ID : " . $note['id'] . "</p>";
        $html .= "<p>Contenu : " . $note['content'] . "</p>";
        $html .= "<hr>";
    }
} else {
    $html .= "Aucune note trouvée pour la maintenance ID : " . $maintenanceId;
}

// Envoyer la réponse
echo $html;
?>