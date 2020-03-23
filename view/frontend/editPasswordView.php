<?php $title = 'GBAF | Réinitialisation'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>
    <?php require('model/include/errorsMessage.php'); ?>

    <div class="primary_background my-5">
        <h1 class="primary_h1">Modifier votre mot de passe</h1>
        <h3 class="primary_h3">Changer votre mot de passe définitivement</h3>

        <div class="ml-5 mt-3 mb-3">
            <a class="btn btn-danger btn-sm" href="index.php?action=editprofil" role="button">Retour</a>
        </div>

        <form method="post" action="index.php?action=editpassword" class="was-validated">
        
            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/person-fill.svg" alt=""></span>
                </div>
                <input type="text" class="form-control form-control-lg" aria-describedby="inputGroupPrepend" name="username" id="username" value="<?=$_SESSION['auth']['username']?>" disabled>
            </div>

            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/lock-fill.svg" alt=""></span>
                </div>
                <input type="password" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="password_old" id="password_old" placeholder="Mot de passe actuel"required>
                <div class="invalid-feedback">
                    Veuillez saisir votre mot de passe actuel.
                </div>
            </div>

            <div class="primary_input input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend"> <abbr title="Un mot de passe valide aura : 
                    - de 8 à 15 caractères
                    - au moins une lettre minuscule
                    - au moins une lettre majuscule
                    - au moins un chiffre
                    - au moins un de ces caractères spéciaux: $ @ % * + - _ !"><img src="node_modules/bootstrap-icons/icons/lock-fill.svg" alt=""></abbr></span>
                    </div>
                    <input type="password" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="password" id="password" placeholder="Nouveau mot de passe" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required>
                    <div class="invalid-feedback">
                        Veuillez saisir votre nouveau mot de passe.
                    </div>
            </div>

            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"> <abbr title="Un mot de passe valide aura : 
                - de 8 à 15 caractères
                - au moins une lettre minuscule
                - au moins une lettre majuscule
                - au moins un chiffre
                - au moins un de ces caractères spéciaux: $ @ % * + - _ !"><img src="node_modules/bootstrap-icons/icons/lock-fill.svg" alt=""></abbr></span>
                </div>
                <input type="password" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="password_confirm" id="password_confirm" placeholder="Confirmer le mot de passe" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required>
                <div class="invalid-feedback">
                    Veuillez saisir à nouveau votre nouveau mot de passe.
                </div>
            </div>
            
            <div id="button_login">
                <input class="btn btn-success" type="submit" value="Enregistrer">
            </div>
        </form>
    </div>

<?php $content = ob_get_clean(); ?>

<?php $footer = 'static';?>

<?php require('view/template.php'); ?>