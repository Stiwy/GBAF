<?php $title = 'GBAF | Profil'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <div class="my-5">
        <h1 class="primary_h1">Mot de passe oublié ?</h1>
        <h3 class="primary_h3">Suivez les étapes pour reinitialisé votre mot de passe</h3>

        <div class="ml-5 mt-3 mb-3">
            <a class="btn btn-danger btn-sm" href="index.php?action=forgot" role="button">Retour</a>
        </div>

        <form method="post" action="index.php?action=resetpassword" class="was-validated">
        
            <div class="primary_input">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-person-fill" width="1.4em" height="1.4em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 16s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H5zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" aria-describedby="inputGroupPrepend" name="username" id="username" value="<?=$_SESSION['username']?>" disabled>
                </div>
            </div>

            <div class="primary_input">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend"> <abbr title="Un mot de passe valide aura : 
                    - de 8 à 15 caractères
                    - au moins une lettre minuscule
                    - au moins une lettre majuscule
                    - au moins un chiffre
                    - au moins un de ces caractères spéciaux: $ @ % * + - _ !"><svg class="bi bi-lock-fill" width="1.4em" height="1.4em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><rect width="11" height="9" x="4.5" y="8" rx="2"></rect><path fill-rule="evenodd" d="M6.5 5a3.5 3.5 0 117 0v3h-1V5a2.5 2.5 0 00-5 0v3h-1V5z" clip-rule="evenodd"></path></svg></abbr></span>
                    </div>
                    <input type="password" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="password" id="password" placeholder="Nouveau mot de passe" required>
                    <div class="invalid-feedback">
                        Veuillez saisir votre nouveau mot de passe.
                    </div>
                </div>
            </div>

            <div class="primary_input">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-lock-fill" width="1.4em" height="1.4em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><rect width="11" height="9" x="4.5" y="8" rx="2"></rect><path fill-rule="evenodd" d="M6.5 5a3.5 3.5 0 117 0v3h-1V5a2.5 2.5 0 00-5 0v3h-1V5z" clip-rule="evenodd"></path></svg></span>
                    </div>
                    <input type="password" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="password_confirm" id="password_confirm" placeholder="Confirmer le mot de passe" required>
                    <div class="invalid-feedback">
                        Veuillez saisir à nouveau votre nouveau mot de passe.
                    </div>
                </div>
            </div>
            
            <div id="button_login">
                <input class="btn btn-success" type="submit" value="Enregistrer">
            </div>
        </form>
    </div>
<?php $content = ob_get_clean(); ?>

<?php $footer = 'fixed';?>

<?php require('view/template.php'); ?>