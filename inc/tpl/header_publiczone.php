<nav>
    <div class='logo'>
        <div class='logo-txt'>
            <a href=""><p>OIKOS</p></a>
        </div>
    </div>
    <div class='icon'>
        <a href=<?= $link_favorite ?>><div class="icon-heart"><img src=<?= $heart_icon ?> alt=""></div></a>
        <div class="icon-account-menu">
            <div class="icon-menu"><img src=<?= $menu_icon ?> alt=""></div>
            <div class="icon-account"><img src=<?= $account_icon ?> alt=""></div>
            <div class="dropdown" id="dropdown">
                <div><a href="../connection/register.php"><p>Inscription</p></a></div>
                <div><a href="../connection/login.php"><p>Connexion</p></a></div>
                <div class="separator"></div>
                <div><a href=""><p>Aide</p></a></div>
            </div>
        </div>
    </div>
</nav>