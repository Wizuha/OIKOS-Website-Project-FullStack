<?php
    require '../inc/pdo.php';
    require '../inc/functions/token_function.php';
    session_start();

    $id = $_SESSION['id'];

    $logout = $website_pdo->prepare("
        UPDATE token SET token = :token WHERE token.user_id = :user
    ");

    $logout->execute([
        ":token" => 'null',
        ":user" => $id
    ]);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;url=./login.php">
    <link href="../assets/css/logout.css" rel="stylesheet">
    <title>OIKOS | Déconnexion</title>
</head>
<body>
    <div class="">
        <p class=""><span class="">Vous avez été déconnecté.</span> <span class="">Merci de votre visite et à bientôt sur Oikos.</span></p>
        <p class="">Vous allez être redirigé dans <span id="countdown">5</span> secondes...</p>
    </div>

    <script src="../assets/js/logout.js"></script>
</body>
</html>

<?php
    session_destroy();
    exit();
?>