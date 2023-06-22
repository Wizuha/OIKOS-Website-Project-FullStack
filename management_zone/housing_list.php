<?php 

    $heart_icon = '../assets/images/heart.svg';
    $menu_icon =   '../assets/images/menu.svg';
    $account_icon = '../assets/images/account.svg';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/header_gestion.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/housing_list.css">
    <title>Document</title>
</head>
<body>
    <?php require '../inc/tpl/header_gestion.php' ?>

    <div>
        <button id="housing-create-btn" class="housing-create-btn">Créer un Logement</button>
    </div>

    <div class="container">
        <div class="input-container">
            <input type="text" placeholder="Recherchez un logement par nom ou id" id="input">
            <img src="../assets/images/search.svg" alt="">
        </div>

        <div class="grid">

        </div>
    </div>
    <script src="../assets/js/housing_list.js"></script>
</body>
</html>
