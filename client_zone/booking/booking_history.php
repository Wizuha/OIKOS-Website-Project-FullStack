<?php

session_start();
require '../../inc/pdo.php';
require '../../inc/functions/booking_function.php';
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

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
    $BookingFuture = getBookingFuture();
    $bookingPast = getBookingPast();
    $BookingCurrent = getBookingCurrent();

    if($method == "POST"){
        for($i=0;$i<$BookingFuture;$i++){
            $booking_id = $BookingFuture[$i]['id'];
            $request_delete_booking = $website_pdo -> prepare('
            DELETE FROM booking 
            WHERE user_id = :user_id
            AND id = :booking_id;
            ');

            $request_delete_booking -> execute ([
                ':user_id'=> 1,
                ':booking_id' => $booking_id
            ]);
            $delete_booking = $request_delete_booking->fetch(PDO::FETCH_ASSOC);
            exit();
        }
    }
       
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

<body>
    <div class="sidebar">
        <button onclick="showFutureBookings()">Réservation future</button>
        <button onclick="showPastBookings()">Réservation passée</button>
        <button onclick="showCurrentBookings()">Réservation actuelle</button>
    </div>

    <div id="futureBookings" style="display: none;">
        <h1>Réservation future</h1>
        <?php if(isset($BookingFuture)){
                foreach($BookingFuture as $row){ ?>
            <ul>
                <h3><?php echo $row['title'] ?></h3>
                <li>Début du séjour : <?php echo $row['start_date_time'] ?></li>
                <li>Fin du séjour : <?php echo $row['end_date_time'] ?></li>
                <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
                <form method = "POST">
                    <input type="submit" value="Annuler votre réservation">
                </form>
            </ul>
        <?php }
        }
        else{
            echo "Vous n'avez pas de réservation !";
        }?>
   </div>

   <div id="pastBookings" style="display: none;">
        <h1>Réservation Passé</h1>
        <?php if (isset($bookingPast)){
                foreach($bookingPast as $row){ ?>
            <ul>
                <h3><?php echo $row['title'] ?></h3>
                <li>Début du séjour : <?php echo $row['start_date_time'] ?></li>
                <li>Fin du séjour : <?php echo $row['end_date_time'] ?></li>
                <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
            </ul>
        <?php }}
        else {
            echo "Vous n'avez pas de réservation";
        }?>
    </div>
    
    <div id="currentBookings" style="display: none;">
        <h1>Réservation Actuelle</h1>
            <?php if (isset($BookingCurrent)){
                    foreach($BookingCurrent as $row){ ?>
                <ul>
                    <h3><?php echo $row['title'] ?></h3>
                    <li>Début du séjour : <?php echo $row['start_date_time'] ?></li>
                    <li>Fin du séjour : <?php echo $row['end_date_time'] ?></li>
                    <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
                </ul>
            <?php }}
            else {
                echo "Vous n'avez pas de réservation";
            }?>
    </div>
</body>
<script>
    function showFutureBookings() {
        document.getElementById("futureBookings").style.display = "block";
        document.getElementById("pastBookings").style.display = "none";
        document.getElementById("currentBookings").style.display = "none";
    }

    function showPastBookings() {
        document.getElementById("futureBookings").style.display = "none";
        document.getElementById("pastBookings").style.display = "block";
        document.getElementById("currentBookings").style.display = "none";
    }

    function showCurrentBookings() {
        document.getElementById("futureBookings").style.display = "none";
        document.getElementById("pastBookings").style.display = "none";
        document.getElementById("currentBookings").style.display = "block";
    }
</script>

</html>