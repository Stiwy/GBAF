<?php $title = 'GBAF | Profil'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>
    <?php 
        setlocale(LC_TIME, 'fr');
        $registration_date = utf8_encode(ucfirst(strftime('%A %d ' ,strtotime($_SESSION['auth']['registration_date']))));
        $registration_date .= utf8_encode(ucfirst(strftime('%B %Y' ,strtotime($_SESSION['auth']['registration_date']))));
    ?>

    <h1 class="primary_h1">Votre compte</h1>
    <h3 class="primary_h3">Bonjour <?= $_SESSION['auth']['firstname']?></h3>

    <section class="container">

        <div class="ml-5 mt-3 mb-3">
            <a class="btn btn-danger btn-md" href="index.php?action=editprofil" role="button">Modifier</a>
        </div>

        <div id="show_profile" class="row align-items-center">
            <div id="show_profile_avatar">
                <img src="public/image/avatar/<?php echo $_SESSION['auth']['avatar']?>" alt="Photo de profil">
            </div>
            <div id="show_profile_user">
                <p id="username_account"><?= $_SESSION['auth']['username'] ?></p>
                <p id="details">Utilisateur du sérvice GBAF</p>
            </div>
        </div>

        <div id="about">
            <h2 class="primary_h2">A propos de moi :</h2>
            <p class="primary_p"><span class="span_account">Prénom :</span> <?= $_SESSION['auth']['firstname'] ?></p>
            <p class="primary_p"><span class="span_account">Nom de famille :</span> <?= $_SESSION['auth']['name'] ?></p>
        </div>

        <div id="account_information">
            <h2 class="primary_h2">Information du compte :</h2>
            <p class="primary_p"><span class="span_account">Question secrète : </span><?= $_SESSION['auth']['question'] ?></p>
            <p class="primary_p"><span class="span_account">Date d'inscription : </span>Le, <?= $registration_date?></p>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>