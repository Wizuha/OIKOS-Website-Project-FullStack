<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/font.css"> <!-- Import des polices -->
    <link rel="stylesheet" href="../assets/css/register.css">
    <title>OIKOS | Inscription</title>
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
                    <input type="password" id="password" required>
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
        <div class="btn" id="btn"><button>S'inscrire</button></div>
        <div class="link"><p>Vous avez déja un compte ? <a href="./login.php"><span>Connectez-vous</span></a></p></div>
    </div>
    <div class="background-img"></div>
    <div class="modal" id="modal">
        <div class="modal-container" id="modal-container">
            <div class='modal-container-title'><h2>Sécurité</h2></div>
            <form>
                <div class='modal-label-input-container'>
                    <label for="security-question">Questions de sécurité</label>
                    <select name="security-question">
                        <option value="" selected disabled hidden id="default">Selectionner une question.</option>
                        <option value="first-pet-name">Quel était le nom de votre 1ère animal de compagnie ?</option>
                        <option value="mother-birth-place">Quel est le lieux de naissance de votre mère.</option>
                        <option value="first-school-name">Quel est le  nom de votre première école.</option>
                        <option value="dream-work">Quel est le métier de vos rève ?</option>
                        <option value="first-love-name">Quel est le nom de votre première amour ?</option>
                    </select>
                </div>
                <div class='modal-label-input-container'>
                    <label for="response">Votre réponse :</label>
                    <input type="text" id="response" name="response">
                </div>
                <div class="modal-label-input-container">
                    <input class='submit' type="submit">
                </div>
            </form>
            <div class='warning'><p>Pour garantir votre sécurité, veuillez remplir cette section</p></div>
        </div>
    </div>
    <script src="../assets/js/register.js"></script>
</body>
</html>