<?php $title = 'GBAF | Se connecter'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 class="primary_h1">Se connecter</h1>
    <h3 class="primary_h3">Connectez-vous pour accéder à votre éspace extranet</h3>
    <p id="p_form" class="col-12"><a href="index.php?action=register">Pas encore inscrit ?</a></p>

    
    <form method="post" action="index.php?action=login" class="row">
        <label class="label" for="username" class="col-12">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" placeholder="Saisissez votre nom d'utilisateur" class="col-12 input">

        <label class="label" for="password" class="col-12">Mot de passe <a href="index.php?action=forgot" id="lost_password">(Mot de passe oublié ?)</a></label>
        <input type="password" name="password" id="password" placeholder="Saisissez votre mot de passe" class="col-12 input">

        <div class="col-12">
            <button class="primary_btn">Se connecter</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>