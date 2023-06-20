<?php
session_start();
require '../../inc/pdo.php';
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

$last_name_error = "";
$first_name_error = "";
$phone_number_error = "";
$mail_error = "";
$birth_date_error = "";

$heart_icon = '../../assets/images/heart.svg';
$menu_icon = '../../assets/images/menu.svg';
$account_icon = '../../assets/images/account.svg';

if (!isset($_SESSION['id'])) {
    header("Location:../../connection/login.php");
    exit; 
}



if($method == 'POST'){
    $first_name = filter_input(INPUT_POST,'firstname');
    $last_name = trim(filter_input(INPUT_POST,'lastname'));
    $phone_number = trim(filter_input(INPUT_POST,'phone_number'));
    $mail = trim(filter_input(INPUT_POST,'mail',FILTER_VALIDATE_EMAIL));
    $birth_date = trim(filter_input(INPUT_POST,'birth_date'));
    
    $empty = true ;
    if(!$first_name){
        $first_name_error = "Le champ Prénom est requis";
        $empty = false ;
    }
    if(!$last_name){
        $first_name_error = "Le champ Nom est requis";
        $empty = false ;
    }
    if(!$phone_number){
        $phone_number_error = "Le champ Numéro de téléphone est requis";
        $empty = false ;
    }   
    if(!$mail){
        $mail_error = "Me champ mail est requis";
        $empty = false ;
    }
    if(!$birth_date){
        $birth_date_error = "Le champs Date de Naissance est requis";
        $empty = false ;
    }

    if($empty){
        $update_info = $website_pdo -> prepare('
        UPDATE user SET 
        firstname = :first_name, lastname = :last_name, phone_number = :phone_number, mail = :mail, birth_date = :birth_date 
        WHERE id = :id;
        ');

        $update_info -> execute ([
            ':last_name' => $last_name,
            ':first_name' => $first_name,
            ':phone_number' => $phone_number,
            ':mail' => $mail,
            ':birth_date' => $birth_date,
            ':id' => $_SESSION['id']
        ]);

        echo 'Vos informations ont bien été mis à jour';

    }
}
$photo_test = "../../assets/images/minuit.png";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/profile.css">
    <link rel="stylesheet" href="../../assets/css/font.css">
    <title>Document</title>
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
    <form method="POST">
        <div class = "container">
            <div class = "container-left">
                <h2>Compte</h2>
                <img src="<?= $photo_test ?>" alt="" class = "picture-user">
                <p>Informations personnelles</p>
                <span>Prénom :</span>
                <input type="text" name = "firstname" placeholder = "Elon" class = "input-text <?php if($first_name_error):?> error-line <?php endif ?>" >
                <span>Numéro de téléphone :</span>
                <input type="tel" name="phone_number" placeholder = "+33" pattern= "^(0|\+33|0033)[1-9]([-. ]?[0-9]{2}){4}$" class = "input-text <?php if($first_name_error):?> error-line <?php endif ?>">
                <span>Date de naissance :</span>
                <input type="date" name="birth_date" placeholder="12/02/2022" class = "input-text <?php if($first_name_error):?> error-line <?php endif ?>">
                <input type="submit" value="Sauvegarder">
            </div>
            <div class = "container-right">
                <span>Nom :</span>
                <input type="text" name="lastname" placeholder = "Musk" class = "input-text <?php if($first_name_error):?> error-line <?php endif ?>">
                <span>Adresse E-mail :</span>
                <input type="text" name= "mail" placeholder="elonmusk@tesla.pk" class = "input-text <?php if($first_name_error):?> error-line <?php endif ?>">
            </div> 
        </div>  
    </form>
</body>
</html>