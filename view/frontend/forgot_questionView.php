<?php $title = 'GBAF | Réinitialisation'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 id="title_form">Mot de passe oublié</h1>
    <p id="sub_title">Suivez les étapes pour reinitialisé votre mot de passe</p>
    <p id="p_form" class="col-12"><a href="index.php?action=forgot">Retour</a></p>

    <?php $_SESSION['username'] = $question['username']; ?>
    
    <form method="post" action="index.php?action=checkquestion"  class="row">
        <label for="username" class="col-12">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" value=" <?=$question['username'] ?>" class="col-12" disabled>

        <label for="reply" class="col-12"><?= $question['question'] ?></label>
        <input type="text" name="reply" id="reply" placeholder="Saisissez la réponse" class="col-12 input">

        <div class="col-12">
            <button id="btn_primary">Suivant</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>