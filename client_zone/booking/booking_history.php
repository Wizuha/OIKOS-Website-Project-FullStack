<?php

session_start();
require '../../inc/pdo.php';
require '../../inc/functions/booking_function.php';
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");


if (!isset($_SESSION['id'])) {
    header("Location:../../connection/login.php");
    exit; 
}


$verify_existing_booking = $website_pdo -> prepare ('
    SELECT housing_id 
    FROM booking WHERE user_id = :user_id;
');
$verify_existing_booking -> execute([
    ':user_id'=> $_SESSION['id']
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
                ':user_id'=> $_SESSION['id'],
                ':booking_id' => $booking_id
            ]);
            $delete_booking = $request_delete_booking->fetch(PDO::FETCH_ASSOC);
            exit();
        }
    }
       
}
$heart_icon = '../../assets/images/heart.svg';
$menu_icon = '../../assets/images/menu.svg';
$account_icon = '../../assets/images/account.svg';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/booking_history.css">
    <link rel="stylesheet" href="../../assets/css/font.css">
    <title>Réservations</title>
</head>

<body>
    <nav>
        <div class='logo'>
            <div class='logo-txt'>
                <a href=""><p>OIKOS</p></a>
            </div>
        </div>
        <div class='icon'>
            <div class="icon-heart"><img src=<?= $heart_icon ?> alt=""></div>
            <div class="icon-account-menu">
                <div class="icon-menu"><img src=<?= $menu_icon ?> alt=""></div>
                <div class="icon-account"><img src=<?= $account_icon ?> alt=""></div>
            </div>
        </div>
        <!-- <div class="drop">

        </div> -->
    </nav>
    <div class="sidebar">
        <button onclick="showFutureBookings()">Réservation future</button>
        <button onclick="showPastBookings()">Réservation passée</button>
        <button onclick="showCurrentBookings()">Réservation actuelle</button>
    </div>

    <div id="futureBookings" style="display: none;" class = "Booking">
        <?php if(isset($BookingFuture)){
                foreach($BookingFuture as $row){ ?>
            <div class = "image_bookings">
                <img src="../../assets/images/img-register2.png" alt="">
            </div>
            <div class = "information_booking">
                <ul>
                    <h2><?php echo $row['title'] ?></h2>
                    <p class = "district"><?php echo $row['district'] ?></p>
                    <div class = "line"></div>
                    <p class = "capacity"><?php echo $row['number_of_pieces'] ?> Pièces - <?php echo $row['area'] ?>m²</p>
                    <li class="check"><p>Check in : </p> <span><?php echo $row['start_date_time'] ?></span></li>
                    <li class="check"><p>Check out : </p> <span><?php echo $row['end_date_time'] ?></span></li>
                    <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
                    <form method = "POST">
                        <input type="submit" value="Annuler votre réservation">
                    </form>
                </ul>
            </div>
        <?php }
        }
        else{
            echo "Vous n'avez pas de réservation !";
        }?>
   </div>

   <div id="pastBookings" style="display: none;" class = "Booking" >
        <?php if (isset($bookingPast)){
                foreach($bookingPast as $row){ ?>
            <div class = "image_bookings">
                <img src="../../assets/images/img-register.png" alt="">
            </div>
            <div class = "information_booking">
                <ul>
                    <h2><?php echo $row['title'] ?></h2>
                    <p class = "district"><?php echo $row['district'] ?></p>
                    <div class = "line"></div>
                    <p class = "capacity"><?php echo $row['number_of_pieces'] ?> Pièces - <?php echo $row['area'] ?>m²</p>
                    <li class="check"><p>Check in : </p>   <span><?php echo $row['start_date_time'] ?></span></li>
                    <li class="check"><p>Check out : </p> <span><?php echo $row['end_date_time'] ?></span></li>
                    <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
                </ul>
            </div>
        <?php }}
        else {
            echo "Vous n'avez pas de réservation";
        }?>
    </div>
    
    <div id="currentBookings" style="display: none;" class = "Booking">
            <?php if (isset($BookingCurrent)){
                    foreach($BookingCurrent as $row){ ?>
            <div class = "image_bookings">
                <img src="../../assets/images/img-register.png" alt="">
            </div>
                <div class = "information_booking">
                    <ul>
                        <h2><?php echo $row['title'] ?> </h2>
                        <p class = "district"><?php echo $row['district'] ?></p>
                        <div class = "line"></div>
                        <p class = "capacity"><?php echo $row['number_of_pieces'] ?> Pièces - <?php echo $row['area'] ?>m²</p>
                        <li class="check"><p>Check in : </p>   <span><?php echo $row['start_date_time'] ?></span></li>
                        <li class="check"><p>Check out : </p> <span><?php echo $row['end_date_time'] ?></span></li>
                        <div class = "details">
                            <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
                            <a href="../clients/index.php?client_id=<?= $_SESSION['id']?>&housing_id=<?= $row['housing_id']?>">Assistance</a>
                        </div>
                    </ul>
                </div>
            <?php }}
            else {
                echo "Vous n'avez pas de réservation";
            }?>
    </div>
</body>
<script>
    showCurrentBookings();
    function showFutureBookings() {
        document.getElementById("futureBookings").style.display = "flex";
        document.getElementById("pastBookings").style.display = "none";
        document.getElementById("currentBookings").style.display = "none";
    }

    function showPastBookings() {
        document.getElementById("futureBookings").style.display = "none";
        document.getElementById("pastBookings").style.display = "flex";
        document.getElementById("currentBookings").style.display = "none";
    }

    function showCurrentBookings() {
        document.getElementById("futureBookings").style.display = "none";
        document.getElementById("pastBookings").style.display = "none";
        document.getElementById("currentBookings").style.display = "flex";
    }
</script>

</html>