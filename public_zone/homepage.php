<php

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/homepage.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <title>OIKOS</title>
</head>
<body>
<header>
    <nav>
        <a href="#" class="logo">OIKOS</a>
        <div class="button_home">
            <a href="">
            <img src="../assets/images/menu.svg" width="20" height="20">
            </a>
            <a href="">
            <img src="../assets/images/user.svg" width="20" height="20">
            </a>
        </div>
    </nav>
</header>
            <div class="page_filtre">
                <div class="message_bienvenue">
                    <p>Bonjour, <br>Bienvenue à Paris, la ville lumière</p>
                </div>
                <div class="filter">
                    <div class="arrondissement">
                        <label for="arrondissement">Arrondissement</label>
                        <select id="arrondissement">
                            <option value="">1er arrondissement</option>
                            <option value="">2eme arrondissement</option>
                            <option value="">3eme arrondissement</option>
                            <option value="">4eme arrondissement</option>
                            <option value="">5eme arrondissement</option>
                            <option value="">6eme arrondissement</option>
                            <option value="">7eme arrondissement</option>
                            <option value="">8eme arrondissement</option>
                            <option value="">9eme arrondissement</option>
                            <option value="">10eme arrondissement</option>
                            <option value="">11eme arrondissement</option>
                            <option value="">12eme arrondissement</option>
                            <option value="">13eme arrondissement</option>
                            <option value="">14eme arrondissement</option>
                            <option value="">15eme arrondissement</option>
                            <option value="">16eme arrondissement</option>
                            <option value="">17eme arrondissement</option>
                        </select>
                    </div>
                    <div class="depart">
                        <label for="depart">Départ</label>
                        <input type="date" id="depart">
                    </div>
                    <div class="arrive">
                        <label for="arrive">Arrivée</label>
                        <input type="date" id="arrive">
                    </div>
                    <div class="voyager">
                        <label for="voyager">Voyageurs</label>
                        <input id="voyager" type="number" min="1" max="30" value="0">
                    </div>
                    <button type="button" class="recherche">Rechercher</button>
                </div>
            </div>
<div class="grid-container">

    <article id="3685" class="location-listing">

      <a class="location-title" href="#">
					MONTMARTRE						</a>

      <div class="location-image">
        <a href="#">
						<img  src="../assets/images/visiter-montmartre.jpg" alt="san francisco">		</a>

      </div>

    </article>

    <article id="3688" class="location-listing">

      <a class="location-title" href="#">
					LE MARAIS						</a>

      <div class="location-image">
        <a href="#">
						<img  src="../assets/images/le-marais.jpg" alt="london">	</a>

      </div>

    </article>

    <article id="3691" class="location-listing">

      <a class="location-title" href="#">
					OPERA						</a>

      <div class="location-image">
        <a href="#">
						<img  src="../assets/images/opera.jpg" alt="new york">	</a>

      </div>

    </article>
</div>

    <div class="all_arrondissement">
        <div class="all_arrondissement_title">
            <h1>Découvrez tout les quartiers</h1>
        </div>
        <div class="all_arrondissement_card">
            <div class="all_arrondissement_top">
                <div class="all_arrondissement_eiffel">
                    <div class="all_arrondissement_eiffel_img">
                        <img src="../assets/images/toureiffel.jpg" alt="">
                    </div>
                    <div class="all_arrondissement_eiffel_title">
                        <h6>Tour Eiffel</h6>
                    </div>
                    <div class="all_arrondissement_eiffel_text">
                        <p>Plus de 30 logements</p>
                    </div>
                </div>
                <div class="all_arrondissement_top_little">
                    <div class="all_arrondissement_marais">
                        <div class="all_arrondissement_marais_img">
                            <img src="../assets/images/marais.png" alt="">
                        </div>
                        <div class="all_arrondissement_marais_title">
                            <h6>Le Marais</h6>
                        </div>
                        <div class="all_arrondissement_marais_text">
                            <p>Plus de 40 logements</p>
                        </div>
                    </div>
                    <div class="all_arrondissement_opera">
                        <div class="all_arrondissement_opera_img">
                            <img src="../assets/images/opera.png" alt="">
                        </div>
                        <div class="all_arrondissement_opera_title">
                            <h6>Opera</h6>
                        </div>
                        <div class="all_arrondissement_opera_text">
                            <p>Plus de 30 logements</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="all_arrondissement_bottom">
                <div class="all_arrondissement_bottom_little">
                    <div class="all_arrondissement_montmartre">
                            <div class="all_arrondissement_montmartre_img">
                                <img src="../assets/images/montmartre.png" alt="">
                            </div>
                            <div class="all_arrondissement_montmartre_title">
                                <h6>Montmartre</h6>
                            </div>
                            <div class="all_arrondissement_montmartre_text">
                                <p>Plus de 30 logements</p>
                            </div>
                        </div>
                        <div class="all_arrondissement_champs">
                            <div class="all_arrondissement_champs_img">
                                <img src="../assets/images/champs.png" alt="">
                            </div>
                            <div class="all_arrondissement_champs_title">
                                <h6>Champs-Elysées</h6>
                            </div>
                            <div class="all_arrondissement_champs_text">
                                <p>Plus de 40 logements</p>
                            </div>
                        </div>
                </div>
                    <div class="all_arrondissement_pantheon">
                        <div class="all_arrondissement_pantheon_img">
                            <img src="../assets/images/pantheon.png" alt="">
                        </div>
                        <div class="all_arrondissement_pantheon_title">
                            <h6>Panthéon</h6>
                        </div>
                        <div class="all_arrondissement_pantheon_text">
                            <p>Plus de 30 logements</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="assurance">
        <div class="nosservices">
            <h1>Un pannel de services à votre disposition</h1>
        </div>
        <div class="elements"> 
            <div class="elements_top">
                <div class="chauffeur">
                    <div class="assurance_icon">
                        <img src="../assets/images/time_to_leave.svg" alt="">
                    </div>
                    <div class="assurance_title">
                        <h6>Vos déplacements assurées</h6>
                    </div>
                    <div class="assurance_text_chauffeur">
                        <p>Un chauffeur vous est assignée afin de vous transporter rapidement et en toute sécurité, et cela commence dès l’arrivée</p>
                    </div>
                </div>
                <div class="guide">
                    <div class="assurance_icon">
                        <img src="../assets/images/map 1.svg" alt="">
                    </div>
                    <div class="assurance_title">
                        <h6>Votre voyage personnalisé</h6>
                    </div>
                    <div class="assurance_text_guide">
                        <p>Pour un voyage enrichissant, nous mettons un(e) guide à votre disposition pour vous accompagner lors de vos visites</p>
                    </div>
                </div>
                <div class="chef">
                    <div class="assurance_icon">
                        <img src="../assets/images/lucide_chef-hat.svg" alt="">
                    </div>
                    <div class="assurance_title">
                        <h6>Vos papilles emerveillées</h6>
                    </div>
                    <div class="assurance_text_chef">
                        <p>Parce que l’on veut aussi vous faire vivre un voyage culinaire, un(e) chef(fe) est à vos services</p>
                    </div>
                </div>
            </div>
            <div class="elements_bottom">
                <div class="child">
                    <div class="assurance_icon">
                        <img src="../assets/images/iconoir_stroller.svg" alt="">
                    </div>
                    <div class="assurance_title">
                        <h6>Vos enfants accompagnés</h6>
                    </div>
                    <div class="assurance_text_child">
                        <p>Car parfois, on souhaite aussi se retrouver à deux, nous mettons en place un service de garde d’enfants</p>
                    </div>
                </div>
                <div class="conciergerie">
                    <div class="assurance_icon">
                        <img src="../assets/images/healthicons_happy-outline.svg" alt="">
                    </div>
                    <div class="assurance_title">
                        <h6>Vos soucis envolés</h6>
                    </div>
                    <div class="assurance_text_conciergerie">
                        <p>Un problème ? Notre service de conciergerie s’en occupe, disponible 24h/24 7/7</p>
                    </div>
                </div>
                <div class="ballon">
                    <div class="assurance_icon">
                        <img src="../assets/images/bi_balloon.svg" alt="">
                    </div>
                    <div class="assurance_title">
                        <h6>Evènements spéciaux</h6>
                    </div>
                    <div class="assurance_text_ballon">
                        <p>Vous prévoyer d'arriver pour une occasion particulière ? Nous préparons votre arrivé spéciale à vos souhaits</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="exception">
        <div class="exception_title">
            <p>Des appartements d'exception</p>
        </div>
        <div class="exception_text">
            <p>Découvrez notre collection d'appartements d'exception à Paris. Plongez dans un univers luxueux et raffiné où chaque détail a été pensé pour vous offrir une expérience de séjour inoubliable. Nos appartements haut de gamme allient élégance, confort et design contemporain, créant ainsi un véritable havre de paix au cœur de la Ville Lumière.<br><br>

                Que vous soyez à la recherche d'une vue imprenable sur la Tour Eiffel, d'un appartement spacieux avec une terrasse privée ou d'un intérieur magnifiquement décoré, notre sélection exclusive saura répondre à vos exigences les plus élevées. Chaque appartement est soigneusement choisi pour son emplacement prestigieux, sa qualité exceptionnelle et son service personnalisé.
            </p>
        </div>
    </div>

    <footer>
        <div class="logo_footer">
            <a href="#">OIKOS</a>
        </div>
        <div class="footer_elements">
            <div class="footer_column_left">
                <div class="footer_column_left_title">
                    <h3>Assistances</h3>
                </div>
                <div class="footer_column_left_elements">
                    <p>Nous contacter</p>
                    <p>Centre d'aide</p>
                    <p>Annulation</p>
                    <p>Signaler un problème</p>
                </div>
            </div>
            <div class="footer_column_middle">
                <div class="footer_column_middle_title">
                    <h3>Nos offres</h3>
                </div>
                <div class="footer_column_middle_elements">
                    <p>Location saisonnière</p>
                    <p>Location longue durée</p>
                    <p>Nos garanties</p>
                    <p>Nos services</p>
                </div>
            </div>
            <div class="footer_column_right">
                <div class="footer_column_right_title">
                    <h3>Politique</h3>
                </div>
                <div class="footer_column_right_elements">
                    <p>Protection des données</p>
                    <p>Conditions générales</p>
                    <p>Fonctionnement du site</p>
                    <p>Gérer mes cookies</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>