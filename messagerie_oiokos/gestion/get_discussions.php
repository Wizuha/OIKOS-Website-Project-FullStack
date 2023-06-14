<?php
require_once '../pdo.php';
session_start();

$requete = $website_pdo->prepare("SELECT * FROM user");
$requete->execute();
$messages = $requete->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($messages);