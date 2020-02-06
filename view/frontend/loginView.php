<?php $title = 'GBAF | Se connecter'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 id="title_form">Se conncter</h1>
    <p id="sub_title">Connectez-vous pour accéder à votre éspace extranet</p>
    <p id="p_form" class="col-12"><a href="index.php?action=register">Pas encore inscrit ?</a></p>

    
    <form method="post" action="index.php?action=login" class="row">
        <label for="username" class="col-12">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" placeholder="Saisissez votre nom d'utilisateur" class="col-12 input">

        <label for="password" class="col-12">Mot de passe <a href="index.php?action=forgot" id="lost_password">(Mot de passe oublié ?)</a></label>
        <input type="password" name="password" id="password" placeholder="Saisissez votre mot de passe" class="col-12 input">

        <div class="col-12">
            <button id="btn_primary">Se connecter</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>