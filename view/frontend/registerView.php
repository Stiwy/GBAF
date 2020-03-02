<?php $title = 'GBAF | S\'inscrire'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 class="primary_h1">S'inscrire</h1>
    <h3 class="primary_h3">Inscrivez-vous pour acceder à l'éspace extranet</h3>
    
    <!-- Error message -->
    <?php
        if (isset($errors)){
            echo '<div class="alert alert-danger"><p>Saissie inccorecte veuillez veriffier vos informations</p><ul>';
                foreach($errors as $error){
                    echo '<li>' . $error . '</li>';
                }
            echo '</ul></div>';
        }
    ?>

    <form method="post" action="index.php?action=addmember" class="row">
        <label class="label" for="name">Votre nom</label>
        <input type="text" name="name" id="name" placeholder="Saisissez votre nom de famille" class="input col-12">

        <label class="label" for="firstname">Votre Prénom</label>
        <input type="text" name="firstname" id="firstname" placeholder="Saisissez votre prénom" class="input col-12">

        <label class="label" for="username">Votre nom d'utilisateur</label>
        <input type="text" name="username" id="username" placeholder="Saisissez votre nom d'utilisateur" class="input col-12">

        <label class="label" for="password"><abbr title="Un mot de passe valide aura : 
                - de 8 à 15 caractères
                - au moins une lettre minuscule
                - au moins une lettre majuscule
                - au moins un chiffre
                - au moins un de ces caractères spéciaux: $ @ % * + - _ !">Votre mot de passe</abbr></label>
        <input type="password" name="password" id="password" placeholder="Saisissez votre mot de passe" class="input col-12">

        <label class="label" for="password_confirm">Confirmer votre mot de passe</label>
        <input type="password" name="password_confirm" id="password_confirm" placeholder="Saisissez à nouveau votre mot de passe" class="input col-12">

        <label class="label" for="question">Question secrète</label>
        <select name="question" id="question" class="input col-12">
            <option selected value="default">Choisir une question</option>
            <option value="Quelle était le nom de votre école primaire ?">Quelle était le nom de votre école primaire ?</option>
            <option value="Quelle était votre surnom d'enfance ?">Quelle était votre surnom d'enfance ?</option>
            <option value="Quelle était le nom de votre animal de compagnie d'enfance ?">Quelle était le nom de votre animal de compagnie d'enfance ?</option>
            <option value="Quelle était le nom de votre ami(e) d'enfance ?">Quelle était le nom de votre ami(e) d'enfance ?</option>
        </select>

        <label class="label" for="reply">Réponse</label>
        <input type="text" name="reply" id="reply" placeholder="Saisissez votre réponse" class="input col-12">

        <input class="label" type="checkbox" name="cg" id="checkbox">
        <label for="checkbox" class="checkbox d-none d-sm-inline">Confirmez avoir lu et accepté les <a href="#">conditions général d'utilisation</a>.</label>
        <label for="checkbox" class="checkbox d-sm-none"><a href="#">conditions général d'utilisation</a>.</label>

        <div class="col-12"><button class="primary_btn" type="submit">S'inscrire</button></div> 
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>