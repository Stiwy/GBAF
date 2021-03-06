<?php $title = 'GBAF | Se connecter'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    
    <div id="div_login" class="my-5">
        <h1 class="primary_h1 my-5">Se connecter</h1>
        <h3 class="primary_h3 mb-5">Connectez-vous pour accéder à votre espace extranet</h3>

        <form method="post" action="index.php?action=login" class="was-validated my-5">
        
            <div class="primary_input">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-person-fill" width="1.4em" height="1.4em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 16s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H5zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" aria-describedby="inputGroupPrepend" name="username" id="username" placeholder="Nom d'utilisateur" required>
                    <div class="invalid-feedback">
                        Veuillez saisir votre nom d'utilisateur.
                    </div>
                </div>
            </div>

            <div class="primary_input">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-lock-fill" width="1.4em" height="1.4em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><rect width="11" height="9" x="4.5" y="8" rx="2"></rect><path fill-rule="evenodd" d="M6.5 5a3.5 3.5 0 117 0v3h-1V5a2.5 2.5 0 00-5 0v3h-1V5z" clip-rule="evenodd"></path></svg></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" aria-describedby="inputGroupPrepend" name="password" id="password" placeholder="Mot de passe" required>
                    <div class="invalid-feedback">
                        Veuillez saisir votre mot de passe. <a href="index.php?action=forgot" class="text-info">Mot de passe oublié ?</a>
                    </div>
                </div>
            </div>
            
            <div id="button_login" class="mb-5">
                <input class="btn btn-success" type="submit" value="Se connecter">
            </div>
        </form>
    </div>
    
<?php $content = ob_get_clean(); ?>

<?php $footer = 'fixed-login';?>

<?php require('view/template.php'); ?>