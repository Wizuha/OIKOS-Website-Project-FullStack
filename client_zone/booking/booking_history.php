<?php

session_start();
require '../../inc/pdo.php';

$verify_existing_booking = $website_pdo -> prepare ('
    SELECT housing_id 
    FROM booking WHERE user_id = :user_id;
');
$verify_existing_booking -> execute([
    ':user_id'=> 1
]);

$result_existing_booking = $verify_existing_booking->fetchAll(PDO::FETCH_ASSOC);

if($result_existing_booking){
    $housing_id = array();
    for($i = 0; $i < count($result_existing_booking);$i++){
        array_push($housing_id, $result_existing_booking[$i]['housing_id']);
    }

    // requete qui affiche toutes les réservations de l'utilisateur (pas encore trié dans le temps)
    $get_my_bookings = $website_pdo -> prepare ('
        SELECT DISTINCT b.start_date_time,b.end_date_time,b.housing_id, h.title, h.id
        FROM booking b 
        JOIN housing h ON b.housing_id = h.id
        WHERE b.user_id = :user_id;
    ');

    $get_my_bookings -> execute ([
        ':user_id' => 1
    ]);

    $get_bookings = $get_my_bookings->fetchAll(PDO::FETCH_ASSOC);
}
else{
    echo "Vous n'avez aucune réservation";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations</title>
</head>
<h1>Futur Réservation</h1>
<body>
    <?php foreach($get_bookings as $row){ ?>
        <ul>
            <h3><?php echo $row['title'] ?></h3>
            <li>Début du séjour : <?php echo $row['start_date_time'] ?></li>
            <li>Fin du séjour : <?php echo $row['end_date_time'] ?></li>
            <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
        </ul>
    <?php } ?>
</body>
</html>