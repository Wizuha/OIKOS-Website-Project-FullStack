<?php
require_once '../../inc/pdo.php';
session_start();
$client_id = $_GET['client_id'];
//recuperer les messages de la base de donnees
$requete = $website_pdo->prepare("SELECT * FROM booking_messaging where client_id = :client_id ");
$requete->execute(
    array(
        ':client_id' => $client_id
    )
);
$messages = $requete->fetchAll(PDO::FETCH_ASSOC);
//envoyer les donnees au client
echo json_encode($messages);