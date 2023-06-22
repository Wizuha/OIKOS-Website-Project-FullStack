<?php
session_start();
require '../inc/pdo.php';
require '../inc/functions/token_function.php';

if(isset($_SESSION['token'])){
    $check = token_check($_SESSION["token"], $website_pdo, $_SESSION['id']);
    if($check == 'false'){
        header('Location: ../connection/login.php');
        exit();
    }else {
        if ($_SESSION['status'] == 0) {
            header ('Location: ../inc/tpl/inactive_user.html');
            exit(); 
        }
        if ($_SESSION['maintenance_role'] == 0){
            header ('Location: ../public_zone/homepage.php');
            exit();
        }
    }   
}elseif(!isset($_SESSION['token'])){
    header('Location: ../connection/login.php');
    exit();
}

// Vérifier si l'ID de la maintenance est spécifié dans l'URL
if (isset($_GET['id'])) {
    $maintenanceId = $_GET['id'];

    // Récupérer les détails de la maintenance à partir de l'ID
    $maintenance_requete = $website_pdo->prepare('
        SELECT m.id, m.status, m.title, m.schedule_date, m.housing_id, hi.image, h.title AS housing_title
        FROM maintenance m
        JOIN housing_image hi ON m.housing_id = hi.housing_id  
        JOIN housing h ON m.housing_id = h.id
        WHERE m.id = :maintenanceId
    ');
    $maintenance_requete->bindParam(':maintenanceId', $maintenanceId, PDO::PARAM_INT);
    $maintenance_requete->execute();
    $maintenance_details = $maintenance_requete->fetch(PDO::FETCH_ASSOC);

} else {
    echo "ID de maintenance non spécifié.";
}


$title = "Checklist: ";

// Traitement du formulaire après soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maintenanceNote = $_POST['maintenance_note'];

    // Vérifier si toutes les cases sont cochées
    $isChecked = true;
    if (isset($maintenance_check) && is_array($maintenance_check)) {
        foreach ($maintenance_check as $maintenance) {
            if (empty($check)) {
                $isChecked = false;
                break;
            }
            
        }
        }

    // Mettre à jour le statut en fonction de la validation
    if ($isChecked) {
        $scheduleDate = '';
        $status = 'fait';
        // Supprimer la maintenance si le mois actuel se termine
        $currentMonthEnd = date('Y-m-t');
        if ($scheduleDate === $currentMonthEnd) {
            // Supprimer la maintenance
            $deleteMaintenance = $website_pdo->prepare('DELETE FROM maintenance WHERE id = :maintenanceId');
            $deleteMaintenance->bindParam(':maintenanceId', $maintenanceId, PDO::PARAM_INT);
            $deleteMaintenance->execute();
        }
    } else {
        $status = 'en cours';
    }

    // Mettre à jour le statut dans la table de maintenance
    $updateMaintenance = $website_pdo->prepare('UPDATE maintenance SET status = :status WHERE id = :maintenanceId');
    $updateMaintenance->bindParam(':status', $status, PDO::PARAM_STR);
    $updateMaintenance->bindParam(':maintenanceId', $maintenanceId, PDO::PARAM_INT);
    $updateMaintenance->execute();

    // Insérer la note de maintenance
    $insertNote = $website_pdo->prepare('INSERT INTO maintenance_note (maintenance_id, user_id, content) VALUES (:maintenanceId, :userId, :content)');
    $insertNote->bindParam(':maintenanceId', $maintenanceId, PDO::PARAM_INT);
    $insertNote->bindParam(':userId', $_SESSION['id'], PDO::PARAM_INT);
    $insertNote->bindParam(':content', $maintenanceNote, PDO::PARAM_STR);
    $insertNote->execute();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
</head>
<body>

    <h2><?php echo $title ?></h2>
    <form action="" method="POST">
        <h3><?php echo $maintenance_details['housing_title']?></h3>
        <p><?php echo "Date limite: " . $maintenance_details['schedule_date']?></p>

        <div class="maintenance-details-section">
            <h4>Entretien de surface</h4>
            <input type="checkbox" name="maintenance_check[]" value="Nettoyage"> Nettoyage<br>
            <input type="checkbox" name="maintenance_check[]" value="Peinture"> Peinture<br>
            <input type="checkbox" name="maintenance_check[]" value="Réparation"> Réparation<br>
            <!-- Ajouter d'autres cases à cocher pour l'entretien de surface si nécessaire -->
        </div>

        <div class="maintenance-details-section">
            <h4>Vérifications techniques</h4>
            <input type="checkbox" name="maintenance_check[]" value="Plomberie"> Plomberie<br>
            <input type="checkbox" name="maintenance_check[]" value="Électricité"> Électricité<br>
            <!-- Ajouter d'autres cases à cocher pour les vérifications techniques si nécessaire -->
        </div>

        <div class="maintenance-details-section">
            <h4>Ajouter une note</h4>
            <textarea name="maintenance_note" rows="4" cols="50"></textarea>
        </div>

        <input type="submit" name="submit" value="Valider">

    </form>
</body>
</html>
