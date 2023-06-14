<?php
    
    require '../inc/pdo.php';
    session_start();
    if (!isset($_GET['housing_id'])) {
        header('Location: ./housing_list.php');
    } else {
        $housing_id = $_GET['housing_id'];
        $housing_info_request = $website_pdo->prepare('
            SELECT id FROM housing
            WHERE id = :id
        ');
        $housing_info_request->execute([
            ':id' => $housing_id
        ]);
        $housing_info_request_result = $housing_info_request->fetch(PDO::FETCH_ASSOC);

        if (!$housing_info_request_result) {
            header('Location: ./housing_list.php');
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
    <title>Logement</title>
</head>
<body>
    <?php require '../inc/tpl/header_gestion.php' ?>
    <div class="manage-housing">
        <div class="manage-housing-title"><h2>Gérer l'annonce</h2></div>
        <div class="manage-housing-form">
            <form action="">
                <div class="form-container-left">
                    <div class="label-input-container">
                        <label for="">Titre du logement :</label>
                        <input type="text">
                    </div>
                    <div class="label-input-container">
                        <label for="">Prix (par nuit) :</label>
                        <input type="text">
                    </div>
                    <div class="label-input-container">
                        <label for="">Capacité</label>
                        <input type="text">
                    </div>
                    <div class="label-input-container">
                        <label for=""></label>
                        <select name="" id="">
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="form-container-right">
                </div>
            </form>
        </div>
    </div>
</body>
</html>