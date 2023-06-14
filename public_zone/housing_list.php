<?php
$_SESSION['id'] = 1;
require '../inc/pdo.php';

$path = 'http://localhost/OIKOS-Fullstack-Project/uploads/';


if(isset($_SESSION['id'])) {
    $user_info = $website_pdo->prepare(
        'SELECT * FROM user WHERE id = :id;'
    );
    $user_info->execute([
        ':id' => $_SESSION['id']
    ]);
    $result_user_info = $user_info->fetch(PDO::FETCH_ASSOC);
    if($result_user_info){
    $mail = $result_user_info['mail'];
    $lastname = $result_user_info['lastname'];
    $pp_image = $result_user_info['pp_image'];
    }

}

if(isset($_SESSION['id'])) {
    $housing_info = $website_pdo->prepare(
        'SELECT * FROM housing WHERE id = :id;'
    );
    $housing_info->execute([
        ':id' => $_SESSION['id']
    ]);
    $result_housing_info = $housing_info->fetch(PDO::FETCH_ASSOC);
    if($result_housing_info){
    $id_housing = $result_housing_info['id'];
    $title = $result_housing_info['title'];
    $place = $result_housing_info['place'];
    $number_of_pieces = $result_housing_info['number_of_pieces'];
    }
}

if(isset($_SESSION['id'])) {
    $housing_img = $website_pdo->prepare(
        "SELECT hi.image, h.id as housing_id, h.title, h.place, h.number_of_pieces, h.area, h.price, h.description, h.capacity, h.type
        FROM housing h
        JOIN housing_image hi ON h.id = hi.housing_id
        ORDER BY hi.housing_id"

    );
    $housing_img->execute();
    $result_housing_img = $housing_img->fetchAll();

}

$recup_district = $website_pdo->prepare(
    "SELECT district from housing ORDER BY id DESC;"
);
$recup_district->execute();
$result_recup_district = $recup_district->fetchAll();

$search_housing = $website_pdo->prepare(
    'SELECT * FROM housing ORDER BY id DESC'
);

if (isset($_POST['submit_booking'])) {
    $search_district_name = $_POST['district_name'];
    $search_capacity = $_POST['capacity_search'];

    $search_housing = $website_pdo->prepare(
        'SELECT * FROM housing WHERE district LIKE :district_name AND capacity >= :capacity ORDER BY id DESC'
    );

    $search_housing->execute([
        ':district_name' => '%' . $search_district_name . '%',
        ':capacity' => $search_capacity
    ]);
}
$search_housing->execute();
$result_search_housing = $search_housing->fetchAll();
////afficher les images qui correspondent
if(isset($_SESSION['id'])) {
    $housing_img = $website_pdo->prepare(
        "SELECT hi.image, h.id as housing_id, h.title, h.place,h.district, h.number_of_pieces, h.area, h.price, h.description, h.capacity, h.type
        FROM housing h
        JOIN housing_image hi ON h.id = hi.housing_id
        ORDER BY hi.housing_id"

    );
    $housing_img->execute();
    $result_housing_img = $housing_img->fetchAll();

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homepage</title>
</head>
<body>
<form action="housing_list2.php" method="POST">
<select name="district_name">
    <!-- <option value="">--Please choose a district--</option> -->

    <?php foreach($result_recup_district as $rrd) :?>
    <option value="<?= $rrd['district']?>"><?= $rrd['district']?></option>
    <?php endforeach ?>
</select>

  <input type="number" name="capacity_search" min="1" max="20">

  <h2>Début</h2>
    <input type="date" name="first_day_search"></br>
    <h2>Fin</h2>
    <input type="date" name="end_day_search">
    <input type="submit" value="Réserver" name="submit_booking">

</form>
<?php

$prev_housing_id = null; // Stocke l'identifiant précédent

    // affiche les images avec les informations de l'appartement
    foreach ($result_housing_img as $row) {
        if ($row['housing_id'] !== $prev_housing_id) {
            // Affiche les informations de l'appartement une seule fois
            ?>
            <div class="housing_info">
                <p><?= $row['title'] ?></p>
                <p><?= $row['place'] ?></p>
                <p><?= $row['number_of_pieces'] ?></p>
                <p><?= $row['area'] ?></p>
                <p><?= $row['price'] ?></p>
                <p><?= $row['description'] ?></p>
                <p><?= $row['capacity'] ?></p>
                <p><?= $row['type'] ?></p>
            </div>
            <?php
        }

        // Affiche l'image
        ?>
        <div class="housing_list">
            <img height="200px" width="200px" src="<?= $path . $row['image'] ?>" alt="">
        </div>
        <?php

        $prev_housing_id = $row['housing_id']; // Mise à jour de l'identifiant précédent
    }

?>
















<!-- <?php 


//foreach($result_housing_img as $rsi) {
foreach ($result_housing_img as $row) {
    ?>
        <div class="housing_list"> 
            <img height="200px" width="200px" src="<?= $path . $row['image'] ?>" alt="">
            <p><?= $row['title'] ?></p>
            <p><?= $row['place'] ?></p>
            <p><?= $row['number_of_pieces'] ?></p>
            <p><?= $row['area'] ?></p>
            <p><?= $row['price'] ?></p>
            <p><?= $row['description'] ?></p>
            <p><?= $row['capacity'] ?></p>
            <p><?= $row['type'] ?></p>
        </div>
        <?php } ?> -->
        
   


<!-- <div class="housing_list"> 

    <img height="200px" width="200px" src="<?= $path . $rsi['image']?>" alt="">
    <p><?= $rsi['title']?></p>
    <p><?= $rsi['place']?></p>
    <p><?= $rsi['number_of_pieces']?></p>
    <p><?= $rsi['area']?></p>
    <p><?= $rsi['price']?></p>
    <p><?= $rsi['description']?></p>
    <p><?= $rsi['capacity']?></p>
    <p><?= $rsi['type']?></p>
</div> -->

</body>
</html>
