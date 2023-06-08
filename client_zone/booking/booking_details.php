<?php
session_start();
require '../../inc/pdo.php';

if(isset($_GET['booking_id'])){
    $booking_ID = $_GET['booking_id'];
}

$get_booking_details = $website_pdo -> prepare('
    SELECT DISTINCT b.housing_id, b.price, b.start_date_time, b.end_date_time, b.booking_date_time,
    h.title, h.place, h.number_of_pieces, h.area, h.price, h.description, h.capacity, h.type
    FROM booking b
    JOIN housing h ON h.id = b.housing_id
    WHERE b.user_id = :user_id AND b.id = :booking_ID
');

$get_booking_details->execute([
    ':user_id'=> 1,
    ':booking_ID'=> $booking_ID
]);

$booking_details = $get_booking_details->fetch(PDO::FETCH_ASSOC);

if($booking_details){
    $title = $booking_details['title'];
    $place = $booking_details['place'];
    $number_of_pieces = $booking_details['number_of_pieces'];
    $area = $booking_details['area'];
    $price = $booking_details['price'];
    $description = $booking_details['description'];
    $capacity = $booking_details['capacity'];
    $type = $booking_details['type'];
    $start_date_time = $booking_details['start_date_time'];
    $end_date_time = $booking_details['end_date_time'];
    $booking_date_time = $booking_details['booking_date_time'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail réservation</title>
</head>
<body>
    <ul>
        <h1><?php echo $title  ?></h1>
        <li><B>Adresse:</B><?php echo $place ?></li>
        <li><B>Nombre de pièces:</B><?php echo $number_of_pieces ?> pièces</li>
        <li><B>Superficie:</B><?php echo $area ?> mètre carré</li>
        <li><B>Prix:</B><?php echo $price ?>€</li>
        <li><B>Description:</B><?php echo $description ?></li>
        <li><B>Capacité:</B><?php echo $capacity ?> personnes</li>
        <li><B>Type:</B><?php echo $type ?></li>
        <li><B>Début du séjour:</B><?php echo $start_date_time ?></li>
        <li><B>Fin du séjour:</B><?php echo $end_date_time ?></li>
        <li><B>Réservation fait le:</B><?php echo $booking_date_time ?></li>
    </ul>
    <a href="./booking_history.php"><button>Retour</button></a>
</body>
</html>