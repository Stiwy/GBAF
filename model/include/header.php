<header> 
     <?php if (isset($_SESSION['auth'])): ?>
        <nav id="menu">
            <ul class="row align-items-center justify-content-between">
                <li class="col-12 col-md-8 col-lg-9 col-xl-10"><a href="index.php"><img id="logo_header" src="public/image/logo_gbaf.png"></a></li>
                <li id="li_auth" class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <img id="auth_avatar" src="public/image/avatar/<?php echo $_SESSION['auth']['avatar']?>" alt="Avatar"> 
                    <span><?=$_SESSION['auth']['firstname'] . ' ' . $_SESSION['auth']['name']?></span>
                    <ul id="sub_menu">
                        <li><a href="index.php?action=account">Mon profil</a></li>
                        <li><a href="index.php?action=logout">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

    <?php else: ?>
        <nav id="menu">
            <ul class="row align-items-center justify-content-between">
                <li class="col-12 col-md-8 col-lg-9 col-xl-10"><a href="index.php"><img id="logo_header" src="public/image/logo_gbaf.png"></a></li>
                <li id="nav_connect" class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <a href="index.php">S'identifier</a>
                    <a href="index.php?action=register">S'inscrire</a>
                </li>
            </ul>
        </nav>

    <?php endif; ?>  

</header>