<?php

require '../inc/pdo.php';



$value = $_POST['value'];
$ok = 'bien reçu';


$get_housing =  $website_pdo->prepare("
SELECT hi.image, h.id as housing_id, h.title, h.place, h.district, h.number_of_pieces, h.area, h.price, h.description, h.capacity, h.type
        FROM housing h
        JOIN housing_image hi ON h.id = hi.housing_id
        WHERE h.title LIKE :value OR h.id LIKE :value
        ORDER BY h.title, hi.housing_id
        ");

$get_housing->execute([
    ':value' => '%' . $value . '%'
]);


$get_housing_result = $get_housing->fetchALL(PDO::FETCH_ASSOC);

echo json_encode($get_housing_result);

?>

