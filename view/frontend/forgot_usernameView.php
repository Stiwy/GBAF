<?php $title = 'GBAF | Réinitialisation'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 class="primary_h1">Mot de passe oublié</h1>
    <h3 class="primary_h3">Suivez les étapes pour reinitialisé votre mot de passe</h3>
    <p id="p_form" class="col-12"><a href="index.php">Retour</a></p>

    <form method="post" action="index.php?action=forgot_username" class="row">
        <label class="label" for="username" class="col-12">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" placeholder="Saisissez votre nom d'utilisateur" class="col-12 input">

        <div class="col-12">
            <button class="primary_btn">Suivant</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>