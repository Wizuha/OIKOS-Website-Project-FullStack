<?php 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/font.css"> <!-- Import des polices -->
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Document</title>
</head>
<body>
    <div class='form'>
        <div class='title'><h1>Connexion</h1></div>
        <form>
            <div class='label-input-container'>
                <label for="email">Email :</label>
                <input type="text" id="email" required>
            </div>
            <div class='label-input-container'>
                <label for="password">Mot de passe</label>
                <input type="text" id="password" required>
            </div>
            <div class='forgot'><a href="./forgot_password.php"><p>Mot de passe oublié ?</p></a></div>
            <div class='label-input-container'>
                <input type="submit" class="submit">
            </div>
        </form>
        <div class='link'><a href=""><p>Inscrivez-vous <span>ici</span></p></a></div>
    </div>
    <div class="background-img"></div>
</body>
</html>