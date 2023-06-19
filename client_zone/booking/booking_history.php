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
    </nav>

    <h1>Vos Réservations</h1>
    <div class="sidebar">
        <button class="side" onclick="showFutureBookings(this)">Réservation future</button>
        <button class="side" onclick="showPastBookings(this)">Réservation passée</button>
        <button class="side active" onclick="showCurrentBookings(this)">Réservation actuelle</button>
    </div>

    <div id="futureBookings" style="display: none;" >
        <?php if(isset($BookingFuture) && $BookingFuture != []){
                foreach($BookingFuture as $row){ ?>
            <div class = "Booking">
                <div class = "image_bookings">
                    <img src="../../assets/images/img-register2.png" alt="">
                </div>
                <div class = "information_booking">
                    <ul>
                        <h2><?php echo $row['title'] ?></h2>
                        <p class = "district"><?php echo $row['district'] ?></p>
                        <div class = "line"></div>
                        <p class = "capacity"><?php echo $row['number_of_pieces'] ?> Pièces - <?php echo $row['area'] ?>m²</p>
                        <div class = "date_details">
                        <li class="check"><p>Check in : </p> <span><?php echo $row['start_date_time'] ?></span></li>
                        <li class="check"><p>Check out : </p> <span><?php echo $row['end_date_time'] ?></span></li>
                        <div class = "details">
                            <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
                        </div>
                </div>
                    </ul>
                </div>
            </div>
            <?php }}
            else{?>
                <p>Vous n'avez pas de réservation.</p>
            <?php } ?>
   </div>

   <div id="pastBookings" style="display: none;">
        <?php if (isset($bookingPast) && $bookingPast != []){
                foreach($bookingPast as $row){ ?>
            <div class = "Booking">
                <div class = "image_bookings">
                    <img src="../../assets/images/img-register.png" alt="">
                </div>
                <div class = "information_booking">
                    <ul>
                        <h2><?php echo $row['title'] ?></h2>
                        <p class = "district"><?php echo $row['district'] ?></p>
                                <div class = "line"></div>
                                <p class = "capacity"><?php echo $row['number_of_pieces'] ?> Pièces - <?php echo $row['area'] ?>m²</p>
                                <div class = "date_details">
                                    <li class="check"><p>Check in : </p>   <span><?php echo $row['start_date_time'] ?></span></li>
                                    <li class="check"><p>Check out : </p> <span><?php echo $row['end_date_time'] ?></span></li>
                                <div class = "details">
                                    <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
                                </div>
                        </div>
                    </ul>
                </div>
            </div>
            <?php }}
            else{?>
                <p>Vous n'avez pas de réservation.</p>
            <?php } ?>
    </div>
    
    <div id="currentBookings" style="display: none;">
            <?php if (isset($BookingCurrent) && $BookingCurrent != []){
                    foreach($BookingCurrent as $row){ ?>
                <div class = "Booking">
                    <div class = "image_bookings">
                        <img src="../../assets/images/img-register.png" alt="">
                    </div>
                        <div class = "information_booking">
                            <ul>
                                <h2><?php echo $row['title'] ?> </h2>
                                <p class = "district"><?php echo $row['district'] ?></p>
                                <div class = "line"></div>
                                <p class = "capacity"><?php echo $row['number_of_pieces'] ?> Pièces - <?php echo $row['area'] ?>m²</p>
                                <div class = "date_details">
                                    <li class="check"><p>Check in : </p>   <span><?php echo $row['start_date_time'] ?></span></li>
                                    <li class="check"><p>Check out : </p> <span><?php echo $row['end_date_time'] ?></span></li>
                                <div class = "details">
                                    <a href="./booking_details.php?booking_id=<?= $row['id'] ?>"><button>Plus de détail</button></a>
                                </div>
                        </div>
                            </ul>
                        </div>
                </div>
                <?php }}
                else{?>>
                    <p >Vous n'avez pas de réservation.</p>
                <?php } ?>
    </div>
</body>
<script>
    
   
      
    let buttons = document.querySelectorAll(".side")
    
    showCurrentBokings()
    function showFutureBookings(e) {
        buttons.forEach(element =>{
            element.classList.remove("active")
        })
        document.getElementById("futureBookings").style.display = "flex";
        document.getElementById("pastBookings").style.display = "none";
        document.getElementById("currentBookings").style.display = "none";
        e.classList.add("active")

    }

    function showPastBookings(e) {
        document.getElementById("futureBookings").style.display = "none";
        document.getElementById("pastBookings").style.display = "flex";
        document.getElementById("currentBookings").style.display = "none";
        buttons.forEach(element =>{
            element.classList.remove("active")
        })
        e.classList.add("active")
    }

    function showCurrentBookings(e) {
        document.getElementById("futureBookings").style.display = "none";
        document.getElementById("pastBookings").style.display = "none";
        document.getElementById("currentBookings").style.display = "flex";
        buttons.forEach(element =>{
            element.classList.remove("active")
        })
        e.classList.add("active")
    }
    function showCurrentBokings() {
        document.getElementById("futureBookings").style.display = "none";
        document.getElementById("pastBookings").style.display = "none";
        document.getElementById("currentBookings").style.display = "flex";
       
    }
</script>

</html>