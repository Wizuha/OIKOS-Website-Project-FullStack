<?php 

require '../inc/pdo.php';
require '../inc/functions/token_function.php';
session_start();

if(isset($_SESSION['token'])){
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

$path = 'http://localhost/OIKOS-Fullstack-Project/uploads/';

//////////////////////////////////////////////////////////////////////////
// BARRE DE RECHERCHE
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
    <title>Document</title>
</head>
<body>
    
<form action="housing_list2.php" method="POST">
<select name="district_name">

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
if (isset($search_housing) && $search_housing !== false && $search_housing !== null) {
    // Vérification des dates de réservation
    if (isset($_POST['first_day_search'], $_POST['end_day_search'])) {
        $first_day_booking = $_POST['first_day_search'];
        $end_day_booking = $_POST['end_day_search'];
        $check_booking_date = $website_pdo->prepare(
            "SELECT * FROM booking
             WHERE (start_date_time < :end_date_time) AND (end_date_time > :start_date_time);"
        );
        $check_booking_date->execute([
            ":end_date_time" => $end_day_booking,
            ":start_date_time" => $first_day_booking
        ]);

        $result_check_booking_date = $check_booking_date->fetchAll();
        if (count($result_check_booking_date) > 0) {
            echo "La période spécifiée est déjà réservée.";
            exit;
            header('Location: ./housing.php');
        } else {
            echo "La période spécifiée est disponible pour réservation.";
        }
    }

    if ($search_housing->rowCount() > 0) {
        ?>
        <section>
            <?php
// $prev_housing_id = null; // Stocke l'identifiant précédent

            foreach ($result_search_housing as $housing) {
                ?>
                <div class="housing_item">
                    <p><?= $housing['title'] ?></p>
                    <p><?= $housing['place'] ?></p>
                    <p><?= $housing['district'] ?></p>
                    <p><?= $housing['number_of_pieces'] ?></p>
                    <p><?= $housing['area'] ?></p>
                    <p><?= $housing['description'] ?></p>
                    <p><?= $housing['capacity'] ?></p>
                    <p><?= $housing['type'] ?></p>
                </div>
                <?php
            }
            ?>
            <?php
                $housing_img = $website_pdo->prepare(
                    "SELECT image FROM housing_image WHERE housing_id = :housing_id"
                );
                $housing_img->execute([':housing_id' => $housing['id']]);
                $result_housing_img = $housing_img->fetchAll();

                foreach ($result_housing_img as $housing_img) {
                    ?>
                    <img height="200px" width="200px" src="<?= $path.$housing_img['image'] ?>" alt="Housing Image">
                    <?php
                }
                ?>
                <a href="housing.php?id=<?= $housing['id']?>">Voir</a>
            <?php
            }
            ?>
    </section>
    <?php
    } else {
        ?>
        <p>Aucun résultat trouvé</p>
        <?php
    }
?>
<a href="housing_list.php">Retour</a>
</body>
</html> 