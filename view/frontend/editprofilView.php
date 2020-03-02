<?php $title = 'GBAF | S\'inscrire';?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 class="primary_h1">Editer mon profil</h1>
    <h3 class="primary_h3">Modifier votre profil utilisateur</h3>

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

    <!-- Form edit profil -->
    <form method="post" action="index.php?action=editprofil" enctype="multipart/form-data" class="row">
        <label class="label" for="name">Votre nom</label>
        <input type="text" name="name" id="name" value="<?= $_SESSION['auth']['name']?>" class="input col-12">

        <label class="label" for="firstname">Votre Prénom</label>
        <input type="text" name="firstname" id="firstname" value="<?= $_SESSION['auth']['firstname']?>" class="input col-12">

        <label class="label" for="username">Votre nom d'utilisateur</label>
        <input type="text" name="username" id="username" value="<?= $_SESSION['auth']['username']?>" class="input col-12">

        <label class="label" for="question">Question secrète</label>
        <select name="question" id="question" class="input col-12">
            <option selected value="<?= $_SESSION['auth']['question']?>"><?= $_SESSION['auth']['question']?></option>
            <option value="Quelle était le nom de votre école primaire ?">Quelle était le nom de votre école primaire ?</option>
            <option value="Quelle était votre surnom d'enfance ?">Quelle était votre surnom d'enfance ?</option>
            <option value="Quelle était le nom de votre animal de compagnie d'enfance ?">Quelle était le nom de votre animal de compagnie d'enfance ?</option>
            <option value="Quelle était le nom de votre ami(e) d'enfance ?">Quelle était le nom de votre ami(e) d'enfance ?</option>
        </select>

        <label class="label" for="reply">Réponse</label>
        <input type="text" name="reply" id="reply" value="<?= $_SESSION['auth']['reply']?>" class="input col-12">

        <label class="label" for="avatar">Ajouter une image de profil</label>
        <input type="file" name="avatar" id="avatar" class="input col-12">

        <p class="col-12">><a href="index.php?action=resetpassword">  Modfier votre mot de passe</a></p>

        <div class="col-12"><button class="primary_btn" type="submit">Enregistrer</button></div> 
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>