<?php $title = 'GBAF | S\'inscrire'; ?>

<?php ob_start(); ?>


    <!-- Error message -->
    <?php include 'model/include/flash.php';?>
    <?php include 'model/include/errorsMessage.php';?>
    
    <div class="my-5">

        <h1 class="primary_h1 mb-5">S'inscrire</h1>
        <h3 class="primary_h3 mb-5">Inscrivez-vous pour acceder à l'espace extranet</h3>

        <div class="ml-5 mt-3 mb-3">
            <a class="btn btn-danger btn-sm" href="index.php" role="button">Déjà inscrit ?</a>
        </div>

        <form method="post" action="index.php?action=register" class="was-validated">
            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/info-fill.svg" alt=""></span>
                </div>
                <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="name" id="name" placeholder="Nom de famille" minlength="3" maxlength="15" <?php if (isset($_SESSION['input']['name'])) {echo 'value="' . $_SESSION['input']['name'] . '"';}?> required>
                <div class="invalid-feedback">Veuillez saisir votre nom de famille.</div>
            </div>

            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/info-fill.svg" alt=""></span>
                </div>
                <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="firstname" id="firstname" placeholder="Prénom" minlength="3" maxlength="15" <?php if (isset($_SESSION['input']['firstname'])) {echo 'value="' . $_SESSION['input']['firstname'] . '"';}?> required>
                <div class="invalid-feedback">Veuillez saisir votre prénom.</div>
            </div>

            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/person-fill.svg" alt=""></span>
                </div>
                <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="username" id="username" placeholder="Nom d'utilisateur" minlength="3" maxlength="25" <?php if (isset($_SESSION['input']['username'])) {echo 'value="' . $_SESSION['input']['username'] . '"';}?> required>
                <div class="invalid-feedback">Veuillez saisir votre nom d'utilisateur.</div>
            </div>

            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <abbr title="Un mot de passe valide aura : 
                - de 8 à 15 caractères
                - au moins une lettre minuscule
                - au moins une lettre majuscule
                - au moins un chiffre
                - au moins un de ces caractères spéciaux: $ @ % * + - _ !"><img src="node_modules/bootstrap-icons/icons/lock-fill.svg" alt=""></abbr></span>
                </div>
                <input type="password" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="password" id="password" placeholder="Mot de passe" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required>
                <div class="invalid-feedback">Veuillez saisir votre Mot de passe.</div>
            </div>

            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/lock-fill.svg" alt=""></span>
                </div>
                <input type="password" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="password_confirm" id="password_confirm" placeholder="Confirmer le mot de passe" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required>
                <div class="invalid-feedback">Veuillez saisir à nouveau votre mot de passe.</div>
            </div>

            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/question-square-fill.svg" alt=""></span>
                </div>
                <select name="question" id="question" class="custom-select custom-select-md" required>
                    <option selected value="">Choisir une question</option>
                    <option value="Quelle était le nom de votre école primaire ?">Quelle était le nom de votre école primaire ?</option>
                    <option value="Quelle était votre surnom d'enfance ?">Quelle était votre surnom d'enfance ?</option>
                    <option value="Quelle était le nom de votre animal de compagnie d'enfance ?">Quelle était le nom de votre animal de compagnie d'enfance ?</option>
                    <option value="Quelle était le nom de votre ami(e) d'enfance ?">Quelle était le nom de votre ami(e) d'enfance ?</option>
                </select>
                <div class="invalid-feedback">Sélectionnez une question secrète</div>
            </div>

            <div class="primary_input input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/shield-lock-fill.svg" alt=""></span>
                </div>
                <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="reply" id="reply" placeholder="Réponse" required>
                <div class="invalid-feedback">Veuillez saisir votre réponse.</div>
            </div>

            <div class="custom-control custom-checkbox ml-2 mb-3">
                <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="cg" required>
                <label class="custom-control-label d-none d-sm-inline" for="customControlValidation1">Confirmez avoir lu et accepté les <a href="index.php?page=legal">conditions général d'utilisation</a>.</label>
                <label class="custom-control-label d-sm-none" for="customControlValidation1"><a href="index.php?page=legal">conditions général d'utilisation</a>.</label>
                
                <div class="invalid-feedback">Vous devez lire et accepter les conditions général d'utilisation</div>
            </div>

            <div id="button_login">
                <button class="btn btn-success" type="submit">S'inscrire</button>
            </div> 
        </form>
    </div>

    <?php unset($_SESSION['input']) ?>  
    
<?php $content = ob_get_clean(); ?>

<?php $footer = 'static';?>

<?php require('view/template.php'); ?>