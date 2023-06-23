<?php

// Ici in veut checker si l'utilisateur est connecté pour pourvoir afficher le bon header
require '../inc/pdo.php';
require '../inc/functions/token_function.php';
session_start();

// J'ai pas les sessions donc j'ai mis ça
$check = token_check($_SESSION['token'], $website_pdo, $_SESSION['id']);

if($check == 'true'){
    echo('connected');
}else{
    echo('disconnected');
}
