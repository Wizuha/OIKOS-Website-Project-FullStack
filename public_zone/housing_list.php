<?php 
    $heart_icon = '../assets/images/heart.svg';
    $menu_icon =   '../assets/images/menu.svg';
    $account_icon = '../assets/images/account.svg';
    $link_favorite = '../client_zone/profile/favorites.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/header_publiczone.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/housing_list_publiczone.css">
    <script src="../assets/js/carousel.js"></script>
    <title>Document</title>
</head>
<body>
    <?php require '../inc/tpl/header_publiczone.php' ?>
    <div class="container-housinglist">
        <div class='input'>
        <form method="POST">
            <div class="container-label-input">
                <label for="">Quartier</label>
                <select name="" id="">
                    <option value="Le Marais">Le Marais</option>
                    <option value="Montmartre">Montmartre</option>
                    <option value="Tour Eiffel">Tour Eiffel</option>
                    <option value="Champs-Elysés">Champs-Elysés</option>
                    <option value="Opéra">Opéra</option>
                </select>
            </div>
            <div class="separator"></div>
            <div class="container-label-input">
                <label for="">Arrivée</label>
                <input type="date">
            </div>
            <div class="separator">
            </div>
            <div class="container-label-input">
                <label for="">Départ</label>
                <input type="date">
            </div>
            <div class="separator">
            </div>
            <div class="container-label-input">
                <label for="">Voyageurs</label>
                <input type="number">
            </div>
            <div class="container-label-input">
                <input type="submit">
            </div>
        </form>
        </div>
        <div class="house-list">
            <div class="house-item">
                <div class="house-img">
                    <div class="slider-nav">
                        <div class='arrow-left' onclick=previous()><img src="../assets/images/chevron-left.svg" alt=""></div>
                        <div class='arrow-right' onclick=next()><img src="../assets/images/chevron-right.svg" alt=""></div>
                    </div>
                    <div class="slider-content">
                        <div class="slider-content-item">
                            <img src="../assets/images/minuit.png" alt="">
                        </div>
                        <div class="slider-content-item">
                            <img src="../assets/images/minuit2.png" alt="">
                        </div>
                        <div class="slider-content-item">
                            <img src="../assets/images/minuit3.png" alt="">
                        </div>
                        <div class="slider-content-item">
                            <img src="../assets/images/minuit4.png" alt="">
                        </div>
                    </div>
                </div>
                    <!-- <img src="../assets/images/minuit.png" alt=""></div> -->
                <div class="house-important">
                    <div class="house-important-top">
                        <div class="house-title"><h2>LE MINUIT</h2></div>
                        <div class="house-district"><p>Opéra Garnier</p></div>
                    </div>
                    <div class="house-important-bottom">
                        <div class="house-area"><p>5 Pièces - 189 m²</p></div>
                        <div class="house-capacity"><p>10 voyageurs</p></div>
                        <div class="house-icon">
                            <div class="icon-self">
                                <div class='icon-img'><img src="../assets/images/agreement.svg" alt=""></div>
                                <div class='icon-txt'><p>Meeting Room</p></div>
                            </div>
                            <div class="icon-self">
                                <div class='icon-img'><img src="../assets/images/piano.svg" alt=""></div>
                                <div class='icon-txt'><p>Piano</p></div>
                            </div>
                            <div class="icon-self">
                                <div class='icon-img'><img src="../assets/images/audio.svg" alt=""></div>
                                <div class='icon-txt'><p>Home Cinema</p></div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="house-description-btn">
                    <div class="house-description"><p>Pour cet appartement parisien les architectes ont également créé sur-mesure une collection dédiée de mobiliers : vastes canapés, divans et tables basses, aux dimensions époustouflantes et aux matières précieuses : l’acier miroir, la fourrure florentine, le python, le cuir, le velours vénitien…</p></div>
                    <div class="house-btn-heart">
                        <div class="house-btn">
                            <a href="./housing.php"><button>Voir Plus</button></a>
                        </div>
                        <div class="house-heart">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987Z" stroke="#DD3F57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/header_public.js"></script>
</body>
</html>