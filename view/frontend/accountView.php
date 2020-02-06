<?php $title = 'GBAF | ' . $_SESSION['auth']['username']; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 id="title_form">Votre compte</h1>
    <p id="sub_title">Bonjour <?= $_SESSION['auth']['firstname']?></p>

    <section class="container">
        <div id="div_btn"><a id="btn_primary" href="index.php?action=editprofil">Modifier</a ></div>

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
            <h2>A propos de moi :</h2>
            <p><span class="span_account">Prénom :</span> <?= $_SESSION['auth']['firstname'] ?></p>
            <p><span class="span_account">Nom de famille :</span> <?= $_SESSION['auth']['name'] ?></p>
        </div>

        <div id="account_information">
            <h2>Information du compte :</h2>
            <p><span class="span_account">Question secrète : </span><?= $_SESSION['auth']['question'] ?></p>
            <p><span class="span_account">Date d'inscription : </span>Le, <?= $_SESSION['date_fr']?></p>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>