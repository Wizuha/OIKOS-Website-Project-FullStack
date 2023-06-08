<?php
    require '../../inc/pdo.php';
    session_start();

    $user_info_request = $website_pdo->prepare('
        SELECT * FROM user
    ');
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="create-housing-main-content" id="create-housing-main-content">
        <h2 class="page-title">Création d'une Annonce</h2>

        <form method="POST">
            <div class="create-housing-left-content">
                <div class="input-block-text">
                    <label for="housing-title">Titre du logement</label>
                    <input type="text" name="housing-title" id="housing-title" class="input-text" placeholder="Le fabuleux">
                </div>

                <div class="input-block-text">
                    <label for="housing-price">Prix (par nuit)</label>
                    <input type="text" name="housing-price" id="housing-price" class="input-text">
                </div>

                <div class="input-block-text">
                    <label for="housing-capacity">Capacité</label>
                    <input type="text" name="housing-capacity" id="housing-capacity" class="input-text">
                </div>

                <div class="input-block">
                    <label for="housing-type">Type</label>
                    <select name="housing-type" id="housing-type" class="input-select">
                        <option selected disabled hidden value="">Choisissez un type de logement</option>
                    </select>
                </div>

                <div class="input-block" id="select-img-block">
                    <label for="img-file">Images</label>
                    <input type="file" id="img-file" accept="image/*" hidden multiple>
                    <button id="img-file-button">Charger des images</button>
                </div>
            </div>

            <div class="create-housing-right-content">
                <div class="input-block-text">
                    <label for="housing-localisation">Localisation</label>
                    <input type="text" name="housing-localisation" id="housing-localisation" class="input-text" placeholder="Paris - Le Marais">
                </div>

                <div class="input-block-text">
                    <label for="housing-area">Surface</label>
                    <input type="text" name="housing-area" id="housing-area" class="input-text">
                </div>

                <div class="input-block-text">
                    <label for="housing-description">Description</label>
                    <input type="text" name="housing-description" id="housing-description" class="input-text">
                </div>
                
                <div class="checkbox-block">
                    <p>Services proposés</p>

                    <div class="checkbox-options">
                        <div class="input-checkbox">
                            <label for="conciergerie">Conciergerie</label>
                            <input type="checkbox" name="conciergerie" id="concergerie" value="conciergerie">
                        </div>

                        <div class="input-checkbox">
                            <label for="driver">Conciergerie</label>
                            <input type="checkbox" name="driver" id="driver" value="driver">
                        </div>

                        <div class="input-checkbox">
                            <label for="chef">Chef cuisinier</label>
                            <input type="checkbox" name="chef" id="chef" value="chef">
                        </div>

                        <div class="input-checkbox">
                            <label for="babysitting">Conciergerie</label>
                            <input type="checkbox" name="babysitting" id="babysitting" value="babysitting">
                        </div>

                        <div class="input-checkbox">
                            <label for="guide">Guide</label>
                            <input type="checkbox" name="guide" id="guide" value="guide">
                        </div>
                    </div>
                </div>
            </div>

            <input type="submit" value="Créer">
        </form>
    </div>

    <script>
        const imgBtn = document.getElementById('img-file-button'); 
        const imgInput = document.getElementById('img-file');
        
        imgBtn.addEventListener('click', () => {
            imgInput.click();
        });

        imgInput.addEventListener("change", function (e) {
            const files = imgInput.files;
            const uploadImgBlock = document.getElementById('select-img-block');
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileName = file.name;
                const fileSize = file.size;
                const fileType = file.type;
                if (i < files.length -1) {
                    uploadImgBlock.innerHTML += `<span>${fileName}, </span>`
                } else {
                    uploadImgBlock.innerHTML += `<span>${fileName}.</span>`
                }
            }
        });

    </script>
</body>
</html>