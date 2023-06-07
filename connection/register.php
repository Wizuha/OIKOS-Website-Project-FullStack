<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/font.css"> <!-- Import des polices -->
    <link rel="stylesheet" href="../assets/css/register.css">
    <title>Document</title>
</head>
<body>
    <div class='form'>
        <div class='title'><h1>Bienvenue sur Oikos</h1></div>
        <form method=''>
            <div class='form-container-left'>
                <div class='label-input-container'>
                    <label for="lastname">Nom :</label>
                    <input type="text" id="lastname" required>
                </div>

                <div class='label-input-container'>
                    <label for="mail">Email :</label>
                    <input type="text" id="mail" required>
                </div>

                <div class='label-input-container'>
                    <label for="phonenumber">Numéro de téléphone :</label>
                    <input type="tel" id="phonenumber" pattern="^[+]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}$" required>
                </div>
                <div class='label-input-container'>
                    <label for="password">Mot de passe :</label>
                    <input type="text" id="password" required>
                </div>
            </div>
            <div class='form-container-right'>
                <div class='label-input-container'>
                    <label for="firstname">Prénom :</label>
                    <input type="text" id="firstname" required>
                </div>

                <div class='label-input-container'>  
                    <label for="birthdate">Date de naissance</label>
                    <input type="date" id="birthdate" required>
                </div>

                <div class="label-input-container hide">
                    <label for=""></label>
                    <input type="text" disabled>
                </div>
                <div class='label-input-container'>
                    <label for="confirmpassword">Confirmer le mot de passe :</label>
                    <input type="text" id="confirmpassword" required>
                </div>
            </div>
        </form>
        <div class="btn"><button>S'inscrire</button></div>
        <div class="link"><p>Vous avez déja un compte ? <a href="./login.php"><span>Connectez-vous</span></a></p></div>
    </div>
    <div class="background-img"></div>
</body>
</html>