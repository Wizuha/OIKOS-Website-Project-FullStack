<?php
    
    require '../inc/pdo.php';
    session_start();
    if (!isset($_GET['housing_id'])) {
        header('Location: ./housing_list.php');
    } else {
        $housing_id = $_GET['housing_id'];
        $housing_info_request = $website_pdo->prepare('
            SELECT id, title, place, district, number_of_pieces, area, price, description, capacity, type FROM housing
            WHERE id = :id
        ');
        $housing_info_request->execute([
            ':id' => $housing_id
        ]);
        $housing_info_request_result = $housing_info_request->fetch(PDO::FETCH_ASSOC);

        if (!$housing_info_request_result) {
            header('Location: ./housing_list.php');
        } else {
            $housing_id = $housing_info_request_result['id'];
            $housing_title = $housing_info_request_result['title'];
            $housing_place = $housing_info_request_result['place'];
            $housing_district = $housing_info_request_result['district'];
            $housing_number_of_pieces = $housing_info_request_result['number_of_pieces'];
            $housing_area = $housing_info_request_result['area'];
            $housing_price = $housing_info_request_result['price'];
            $housing_description = $housing_info_request_result['description'];
            $housing_capacity = $housing_info_request_result['capacity'];
            $housing_type = $housing_info_request_result['type'];
            
            $housing_img_request = $website_pdo->prepare('
                SELECT image, id from housing_image
                WHERE housing_id = :housing_id
            ');
            $housing_img_request->execute([
                ':housing_id' => $housing_id
            ]);
            $housing_img_request_result = $housing_img_request->fetchAll(PDO::FETCH_ASSOC);

            $housing_service_request = $website_pdo->prepare('
                SELECT concierge, driver, chef, babysitter, guide FROM housing_service
                WHERE housing_id = :housing_id
            ');
            $housing_service_request->execute([
                ':housing_id' => $housing_id
            ]);
            $housing_service_request_result = $housing_service_request->fetch(PDO::FETCH_ASSOC);

            $housing_concierge = $housing_service_request_result['concierge'];
            $housing_driver = $housing_service_request_result['driver'];
            $housing_chef = $housing_service_request_result['chef'];
            $housing_babysitter = $housing_service_request_result['babysitter'];
            $housing_guide = $housing_service_request_result['guide'];

            $housing_booking_request = $website_pdo->prepare('
                SELECT lastname, firstname, booking.id, user_id, start_date_time, end_date_time, booking_date_time, price, concierge, driver, chef, babysitter, guide FROM booking
                INNER JOIN booking_service ON booking.id =  booking_service.booking_id
                INNER JOIN user ON booking.user_id = user.id 
                WHERE housing_id = :housing_id
                ORDER BY start_date_time DESC
            ');
            $housing_booking_request->execute([
                ':housing_id' => $housing_id
            ]);
            $housing_booking_request_result = $housing_booking_request->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    $heart_icon = '../assets/images/heart.svg';
    $menu_icon =   '../assets/images/menu.svg';
    $account_icon = '../assets/images/account.svg'; 

?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/header_gestion.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/modify_housing.css">
    <title>Logement</title>
</head>
<body>
    <?php require '../inc/tpl/header_gestion.php' ?>
    <figure>
        <img src="../uploads/<?= $housing_img_request_result[0]['image'] ?>" alt="Photo de l'appartement" width="60%">
        <figcaption><h1><?= $housing_title ?></h1></figcaption>
    </figure>

    <h2><?= $housing_district ?> - Paris</h2>
    
</body>
</html>