<?php $title = 'GBAF | Réinitialisation'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <?php $_SESSION['username'] = $question['username']; ?>

    <div class="my-5">
        <h1 class="primary_h1">Mot de passe oublié ?</h1>
        <h3 class="primary_h3">Suivez les étapes pour reinitialisé votre mot de passe</h3>

        <div class="ml-5 mt-3 mb-3">
            <a class="btn btn-danger btn-sm" href="index.php?action=forgot" role="button">Retour</a>
        </div>
        <form method="post" action="index.php?action=checkquestion" class="was-validated">
        
            <div class="primary_input">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-person-fill" width="1.4em" height="1.4em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 16s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H5zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" aria-describedby="inputGroupPrepend" name="username" id="username" value=" <?=$question['username'] ?>" disabled>
                </div>
            </div>

            <div class="primary_input">
                <label for="reply"><?= $question['question'] ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-shield-lock-fill" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.187 3.025C8.23 2.749 9.337 2.5 10 2.5c.662 0 1.77.249 2.813.525a61.1 61.1 0 012.772.815c.527.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.368 9.365a11.19 11.19 0 01-2.417 2.3 6.942 6.942 0 01-1.007.586c-.27.124-.558.225-.796.225s-.527-.101-.796-.225a6.908 6.908 0 01-1.007-.586 11.192 11.192 0 01-2.418-2.3c-1.611-2.058-2.94-5.168-2.367-9.365A1.454 1.454 0 014.415 3.84a61.105 61.105 0 012.772-.815zm3.328 6.884a1.5 1.5 0 10-1.06-.011.5.5 0 00-.044.136l-.333 2a.5.5 0 00.493.582h.835a.5.5 0 00.493-.585l-.347-2a.501.501 0 00-.037-.122z" clip-rule="evenodd"></path></svg></span>
                    </div>
                    <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="reply" id="reply" placeholder="Réponse" required>
                    <div class="invalid-feedback">
                        Veuillez saisir votre réponse.
                    </div>
                </div>
            </div>
            
            <div id="button_login">
                <input class="btn btn-success" type="submit" value="Suivant">
            </div>
        </form>
    </div>
<?php $content = ob_get_clean(); ?>

<?php $footer = 'fixed';?>

<?php require('view/template.php'); ?>