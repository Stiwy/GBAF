<header class="row align-items-center"> 

    <div><img id="logo_header" src="public/image/logo_gbaf.png"></div>

    <?php if (isset($_SESSION['auth'])): ?>
        <div id="header_div_auth">
            <ul>
                <li><img class="d-none d-sm-block" src="public/image/avatar/<?php echo $_SESSION['auth']['avatar']?>" alt="Avatar"></li>
                <li><?=$_SESSION['auth']['firstname'] . ' ' . $_SESSION['auth']['name'] ?>
                    <ul id="header_nav_auth">
                        <li><a href="index.php?action=account">Mon profil</a></li>
                        <li><a href="index.php?action=logout">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    <?php else: ?>

    <?php endif; ?>  

</header>