<header> 
     <?php if (isset($_SESSION['auth'])): ?>
        <nav id="menu">
            <ul class="row align-items-center justify-content-between">
                <li><a href="index.php"><img id="logo_header" src="public/image/logo_gbaf.png"></a></li>
                <li>
                    <img id="auth_avatar" src="public/image/avatar/<?php echo $_SESSION['auth']['avatar']?>" alt="Avatar"> 
                    <?=$_SESSION['auth']['firstname'] . ' ' . $_SESSION['auth']['name'] ?>
                    <ul id="sub_menu">
                        <li><a href="index.php?action=account">Mon profil</a></li>
                        <li><a href="index.php?action=logout">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

    <?php else: ?>

    <?php endif; ?>  

</header>