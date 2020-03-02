<?php $title = 'GBAF | Réinitialisation'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 class="primary_h1">Mot de passe oublié</h1>
    <h3 class="primary_h3">Suivez les étapes pour reinitialisé votre mot de passe</h3>
    <p id="p_form" class="col-12"><a href="index.php?action=forgot">Retour</a></p>

    <?php $_SESSION['username'] = $question['username']; ?>
    
    <form method="post" action="index.php?action=checkquestion"  class="row">
        <label class="label" for="username" class="col-12">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" value=" <?=$question['username'] ?>" class="col-12" disabled>

        <label class="label" for="reply" class="col-12"><?= $question['question'] ?></label>
        <input type="text" name="reply" id="reply" placeholder="Saisissez la réponse" class="col-12 input">

        <div class="col-12">
            <button class="primary_btn">Suivant</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>