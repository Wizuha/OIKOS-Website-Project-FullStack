<?php 
require '../inc/pdo.php';
require '../inc/functions/token_function.php';
session_start();





if(isset($_POST['submit_booking'])) {
if(isset($_SESSION['token'])){
    $check = token_check($_SESSION["token"], $website_pdo, $_SESSION['id']);
    $check = token_check($_SESSION["token"], $website_pdo, $_SESSION['id']);
    if($check == 'false'){
        header('Location: ../connection/login.php');
        exit();
    } elseif($_SESSION['status'] == 'Inactif') {
        echo 'Votre compte est inactif.';
    }
}elseif(!isset($_SESSION['token'])){
    header('Location: ../connection/login.php');
    exit();

}
}

if(isset($_SESSION['id'])) {
    $connected = true;
}else{
    $connected = false;
};

$path = 'http://localhost/OIKOS-Fullstack-Project/uploads/';

$price = 1000;

$housing_id = $_GET['id'];
$housing_info = $website_pdo->prepare(
    "SELECT hi.image, h.id as housing_id, h.title, h.place,h.district, h.number_of_pieces, h.area, h.price, h.description, h.capacity, h.type
    FROM housing h
    JOIN housing_image hi ON h.id = hi.housing_id
    WHERE h.id = :id1
    ORDER BY hi.housing_id"
);
$housing_info->execute([
'id1' => $housing_id
]);
$result_housing_id = $housing_info->fetchAll();


if(isset($_POST['first_day_booking'], $_POST['end_day_booking'])){

var_dump($_POST['first_day_booking'],$_POST['end_day_booking']);

$first_day_booking = ($_POST['first_day_booking']);
$end_day_booking = ($_POST['end_day_booking']);

$check_booking_date = $website_pdo->prepare(
    "SELECT * FROM booking
     WHERE (start_date_time < :end_date_time) AND (end_date_time > :start_date_time);"
);
$check_booking_date->execute([
    ":end_date_time"=>$end_day_booking,
    ":start_date_time"=>$first_day_booking
    ]);
    
$result_check_booking_date = $check_booking_date->fetchAll();
if(count($result_check_booking_date) > 0) {
echo "La période spécifiée est déjà réservée.";
exit;

} else {
echo "La période spécifiée est disponible pour réservation.";

$booking_date = $website_pdo->prepare(
    "INSERT INTO booking (user_id,housing_id, price, start_date_time, end_date_time, booking_date_time)
    VALUES (:user_id,:housing_id, :price, :start_date_time, :end_date_time, NOW());"
);
$booking_date->execute([
    ":user_id"=>$_SESSION['id'],
    ":housing_id"=>$housing_id,
    ":price"=>$price,
    ":start_date_time"=>$first_day_booking,
    ":end_date_time"=>$end_day_booking
]);
$last_insert_id = $website_pdo->lastInsertId();
echo('ici id');
var_dump($last_insert_id);

$service_concierge = isset($_POST['concierge']) ? "1" : "0";
$service_driver = isset($_POST['driver']) ? "1" : "0";
$service_chef = isset($_POST['chef']) ? "1" : "0";
$service_babysitter = isset($_POST['babysitter']) ? "1" : "0";
$service_guide = isset($_POST['guide']) ? "1" : "0";

$client_booking_service = $website_pdo->prepare(
    "INSERT INTO booking_service (booking_id, concierge, driver, chef, babysitter, guide)
    VALUES (:booking_id, :concierge, :driver, :chef, :babysitter, :guide);"
);
$client_booking_service->execute([
    ':booking_id'=>$last_insert_id,
    ':concierge'=>$service_concierge,
    ':driver'=>$service_driver,
    ':chef'=>$service_chef,
    ':babysitter'=>$service_babysitter,
    ':guide'=>$service_guide
]);
}
}

$comment = $website_pdo->prepare(
    'SELECT * FROM housing_review WHERE housing_id = :housing_id'
);
$comment->execute([
    ':housing_id'=>$housing_id
]);
$result_comment = $comment->fetchAll();

if(isset($_POST['comment'])){
    $review = ($_POST['comment']);
$insert_comment = $website_pdo->prepare(
    'INSERT INTO housing_review (housing_id, user_id, review, review_date_time)
    VALUES (:housing_id, :user_id, :review, NOW())'
);
$insert_comment->execute([
    ':housing_id'=>$housing_id,
    ':user_id'=>$_SESSION['id'],
    ':review'=>$review
]);
echo 'Votre commentaire a était ajouter';
header('Location: ./housing.php?id='. $housing_id);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housing</title>
</head>
<body>
    <?php
        foreach ($result_housing_id as $housing_img) {
    ?>
        <img height="200px" width="200px" src="<?= $path.$housing_img['image']?>" alt="housing_photos">
    <?php
        }
    ?>
    <div>
        <p><?= $housing_img['title']?></p>
        <p><?= $housing_img['place']?></p>
        <p><?= $housing_img['district']?></p>
        <p><?= $housing_img['number_of_pieces']?></p>
        <p><?= $housing_img['area']?></p>
        <p><?= $housing_img['price']?></p>
        <p><?= $housing_img['description']?></p>
        <p><?= $housing_img['capacity']?></p>
        <p><?= $housing_img['type']?></p>
    </div>

<form method="POST">
    <h2>Choose your services</h2>

        <input type="checkbox" name="concierge" value="1">
        <label for="concierge">Concierge</label>

        <input type="checkbox" name="driver" value="1">
        <label for="driver">Driver</label>

        <input type="checkbox" name="chef" value="1">
        <label for="chef">Chef</label>

        <input type="checkbox" name="babysitter" value="1">
        <label for="babysitter">Babysitter</label>

        <input type="checkbox" name="guide" value="1">
        <label for="guide">Guide</label>

    <h2>Réservation</h2>
    
        <h2>Début</h2>
        <input type="date" name="first_day_booking"></br>
        <h2>Fin</h2>
        <input type="date" name="end_day_booking">
        <?php if($connected == true){?>
        <input type="submit" value="Réserver" name="submit_booking">
        <?php }else {
        echo "Tu dois crée un compte ou t'inscrire pour pouvoir réserver"
        ?>
        <a href="../connection/login.php">Connexion</a>
        <a href="../connection/register.php">Inscription</a>
        <?php }?>
</form>

<h2>Témoignage</h2>
<?php
    foreach($result_comment as $comment){
        $user_info = $website_pdo->prepare(
            'SELECT * FROM user WHERE id = :user_id'
        );
        $user_info->execute([
            ':user_id'=>$comment['user_id']
        ]);
        $result_user_info = $user_info->fetchAll();
        foreach($result_user_info as $user_info){
            ?>
            <p><?= $user_info['lastname'] . ' ' . $user_info['firstname']?></p>
            <p><?= $comment['review']?></p>
            <?php
        }
        
    }
    ?>
<form method="POST">
        <h2>Ajoutez votre ressentis</h2>
        <textarea name="comment" placeholder="Exprimez-vous..."></textarea>
        <?php if($connected == true){?>
            <input type="submit" name="submit_comment">
        <?php }else {
        echo "Tu dois crée un compte ou te connecter pour pouvoir nous donner ton témoignage"
        ?>
        <a href="../connection/login.php">Connexion</a>
        <a href="../connection/register.php">Inscription</a>
        <?php }?>

    </form>

<a href="housing_list.php">Housing List</a>


</body>
</html>

