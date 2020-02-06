<header> 
     <?php if (isset($_SESSION['auth'])): ?>
        <nav id="menu">
            <ul class="row align-items-center justify-content-between">
                <li><a href="index.php"><img id="logo_header" src="public/image/logo_gbaf.png"></a></li>
                <li>
                    <img id="auth_avatar" src="public/image/avatar/<?php echo $_SESSION['auth']['avatar']?>" alt="Avatar"> 
                    <span class="d-none d-md-inline"><?=$_SESSION['auth']['firstname'] . ' ' . $_SESSION['auth']['name']?></span>
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
                <li><a href="index.php"><img id="logo_header" src="public/image/logo_gbaf.png"></a></li>
                <li>
                    <a href="index.php?action=account">Mon profil</a>
                    <a href="index.php?action=logout">Déconnexion</a>
                </li>
            </ul>
        </nav>

    <?php endif; ?>  

</header>