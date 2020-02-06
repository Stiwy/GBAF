<?php $title = 'GBAF | Réinitialisation'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 id="title_form">Mot de passe oublié</h1>
    <p id="sub_title">Suivez les étapes pour reinitialisé votre mot de passe</p>
    <p id="p_form" class="col-12"><a href="index.php?action=forgot">Retour</a></p>
    
    <form method="post" action="index.php?action=resetpassword"  class="row">
        <label for="username" class="col-12">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" value=" <?php if(isset($_SESSION['username'])) { echo $_SESSION['username'];}else { echo $_SESSION['auth']['username']; } ?>" class="col-12" disabled>

        <label for="password"><abbr title="Un mot de passe valide aura : 
                - de 8 à 15 caractères
                - au moins une lettre minuscule
                - au moins une lettre majuscule
                - au moins un chiffre
                - au moins un de ces caractères spéciaux: $ @ % * + - _ !">Votre mot de passe</abbr></label>
        <input type="password" name="password" id="password" placeholder="Saisissez votre mot de passe" class="input col-12">

        <label for="password_confirm">Confirmer votre mot de passe</label>
        <input type="password" name="password_confirm" id="password_confirm" placeholder="Saisissez à nouveau votre mot de passe" class="input col-12">

        <div class="col-12">
            <button id="btn_primary">Suivant</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>