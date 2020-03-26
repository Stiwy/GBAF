<?php $title = 'GBAF | Ajouter un membre;' ?>

<?php ob_start(); ?>


    <!-- Error message -->
    <?php include 'model/include/flash.php';?>
    <?php include 'model/include/errorsMessage.php';?>
    
    <div class="my-5">

        <h1 class="primary_h1 mb-5">Ajouter un nouveau membre</h1>
        <h3 class="primary_h3 mb-5">Ajouter un nouveau membre à l'espace extranet</h3>

        <form method="post" action="index.php?admin=addmember" class="was-validated">

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
                <select name="role" id="role" class="custom-select custom-select-md" required>
                    <option selected value="user">Utilisateur (defaut)</option>
                    <option value="admin">Admin (Attention se rôle apporte des permissions supplémentaires)</option>
                </select>
                <div class="invalid-feedback">Sélectionnez un rôle pour l'utilisateur</div>
            </div>

            <div id="button_login">
                <button class="btn btn-success" type="submit">Ajouter</button>
            </div> 
        </form>
    </div>

    <?php unset($_SESSION['input']) ?>  
    
<?php $content = ob_get_clean(); ?>

<?php $footer = 'fixed';?>

<?php require('view/template.php'); ?>