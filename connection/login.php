<?php 
    require '../inc/pdo.php';
    require '../inc/functions/token_function.php';
    session_start();
    $method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

    if ($method == "POST"){
        $mail = trim(filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL));
        $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        if ($mail && $password){
            $check_existing_mail = $website_pdo->prepare("
                SELECT * FROM user WHERE mail = :mail
            ");

            $check_existing_mail->execute([
                ":mail" => $mail
            ]);

            $check_existing_mail_result = $check_existing_mail->fetch(PDO::FETCH_ASSOC);

            if ($check_existing_mail_result){
                $id = $check_existing_mail_result['id'];

                if (password_verify($password, $check_existing_mail_result['password'])){
                // if ($password == $check_existing_mail_result['password']){
                    $check_user_status = $website_pdo->prepare("
                        SELECT status FROM user WHERE id = :id
                    ");

                    $check_user_status->execute([
                        ":id" => $id
                    ]);

                    $check_user_status_result = $check_user_status->fetch(PDO::FETCH_ASSOC);

                    $token = token();
                    $update_token = $website_pdo->prepare("
                        UPDATE token SET token = :token
                        WHERE user_id = (SELECT id FROM user WHERE mail = :mail)
                    ");

                    $update_token->execute([
                        ":token" => $token,
                        ":mail" => $mail
                    ]);

                    $_SESSION['id'] = $id;
                    $_SESSION['status'] = $check_user_status_result['status'];
                    $_SESSION['token'] = $token;

                    if ($_SESSION['status'] == 1){
                        header('Location: ../public_zone/homepage.php');
                        exit();
                    }elseif ($_SESSION['statut'] == 0){
                        header('Location: ../client_zone/profile/profile.php');
                        exit();
                    }
                }else{
                    $error = true;
                }
            }else{
                $invalid_user = true;
            }
        }
    }
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/font.css"> <!-- Import des polices -->
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>OIKOS | Connexion</title>
</head>
<body>
    <div class='form'>
        <div class='title'><h1>Connexion</h1></div>
        <form method="POST">
            <div class='label-input-container'>
                <label for="mail">Email</label>
                <input type="text" id="mail" name="mail" required>
            </div>
            <div class='label-input-container'>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class='forgot'><a href="./forgot_password.php"><p>Mot de passe oublié ?</p></a></div>
            <?php if(isset($error)){ ?>
                <div class="error"><p>Identifiants incorrects</p></div>
            <?php } ?>
            <?php if(isset($invalid_user)){ ?>
                <div class="error"><p>Aucun compte n'est associé à cette addresse email</p></div>
            <?php } ?>
            <div class='label-input-container'>
                <input type="submit" class="submit" value="Connexion">
            </div>
        </form>
        <div class='link'><a href=""><p>Inscrivez-vous <span>ici</span></p></a></div>
    </div>
    <div class="background-img"></div>
</body>
</html>