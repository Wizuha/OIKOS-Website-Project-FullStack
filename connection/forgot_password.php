<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/forgot_password.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <title>OIKOS | Mot de passe oublié</title>
</head>
<body>
    <div class='form'>
        <div class='title'><h1>Mot de passe oublié</h1></div>
        <form method="POST">
            <div class='label-input-container'>
                <label for="mail">Votre question de sécurité :</label>
                <div class="question"><p>Question fake</p></div>
            </div>
            <div class='label-input-container'>
                <label for="txt">Votre réponse :</label>
                <input type="texte" name="txt" required>
            </div>

            <div class='label-input-container'>
                <div class="btn" id="btn"><button>Valider</button></div>
            </div>
        </form>
    </div>
<div class="background-img"></div>
<div class="modal" id="modal">
        <div class="modal-container" id="modal-container">
            <div class='modal-container-title'><h2>Nouveau mot de passe</h2></div>
            <form>
                <div class='modal-label-input-container'>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password">
                </div>
                <div class='modal-label-input-container'>
                    <label for="confirmpassword">Confirmez le mot de passe</label>
                    <input type="password" id="confirmpassword" name="confirmpassword">
                </div>
                <div class="modal-label-input-container">
                    <input class='submit' type="submit">
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/js/forgot_password.js"></script>
</body>
</html>