<?php
require '../inc/pdo.php';
$user_id = 5;

$id = $_POST['id'];
$state = $_POST['state'];

if($state == 'add'){
    $fav_insert = $website_pdo->prepare('
    INSERT INTO favorite (user_id, housing_id) VALUES (:user_id, :housing_id)'
);
$fav_insert->execute([
    ':user_id'=>$user_id,
    ':housing_id'=>$id
]);
}elseif ($state == 'remove') {
    $fav_remove = $website_pdo->prepare('
    DELETE FROM favorite WHERE user_id = :user_id AND housing_id = :housing_id
    ');
    $fav_remove->execute([
        ':user_id'=>$user_id,
        ':housing_id'=>$id
    ]);
}



// $send = [
//     'id' => $id,
//     'state' => $state
// ];

header('Content-Type: application/json');
// echo json_encode($send);
?>
