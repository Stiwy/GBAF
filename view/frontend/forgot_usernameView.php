<?php $title = 'GBAF | Réinitialisation'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>
    
    <div class="primary_background my-5">
        <h1 class="primary_h1 text-white">Mot de passe oublié ?</h1>
        <h3 class="primary_h3 text-white">Suivez les étapes pour reinitialisé votre mot de passe</h3>

        <div class="ml-5 mt-3 mb-3">
            <a class="btn btn-danger btn-sm" href="index.php" role="button">Retour</a>
        </div>
        <form method="post" action="index.php?action=forgot" class="was-validated">
        
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
            
            <div id="button_login">
                <input class="btn btn-success" type="submit" value="Suivant">
            </div>
        </form>
    </div>

    <!-- =====Footer===== -->
    <section id="footer" class="fixed-bottom">
        <div>
            <a class="footer_1" href="#">Mention légal</a>
            <a class="footer_2" href="#">Contact</a>
        </div>  
    </section>
    <!-- =====Footer===== -->
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>