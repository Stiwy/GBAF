<?php $title = 'GBAF | Profil';?>

<?php ob_start(); ?>
    <!-- Error message -->
    <?php require('model/include/flash.php'); ?>
    <?php require('model/include/errorsMessage.php'); ?>

    <!-- Form edit profil -->
    <div class="my-5">

        <h1 class="primary_h1">Editer mon profil</h1>
        <h3 class="primary_h3 mb-5">Modifier votre profil utilisateur</h3>

        <div class="ml-5 mt-3 mb-5">
            <a class="btn btn-warning btn-sm" href="index.php?action=editpassword" role="button">Modifier le mot de passe</a>
        </div>

        <form method="post" action="index.php?action=editprofil" enctype="multipart/form-data">
            <div class="primary_input input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/info-fill.svg" alt=""></span>
                    </div>
                    <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="name" id="name" value="<?= (isset($_SESSION['input']['name'])) ? $_SESSION['input']['name'] : $_SESSION['auth']['name']; ?>">
                </div>

                <div class="primary_input input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/info-fill.svg" alt=""></span>
                    </div>
                    <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="firstname" id="firstname" value="<?= (isset($_SESSION['input']['firstname'])) ? $_SESSION['input']['firstname'] : $_SESSION['auth']['firstname']; ?>">
                </div>

                <div class="primary_input input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/person-fill.svg" alt=""></span>
                    </div>
                    <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="username" id="username" value="<?= (isset($_SESSION['input']['username'])) ? $_SESSION['input']['username'] : $_SESSION['auth']['username']; ?>">
                </div>

                <div class="primary_input input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/question-square-fill.svg" alt=""></span>
                    </div>
                    <select name="question" id="question" class="custom-select custom-select-md" required>
                        <option selected value="<?= $_SESSION['auth']['question']?>"><?= $_SESSION['auth']['question']?></option>
                        <option value="Quelle était le nom de votre école primaire ?">Quelle était le nom de votre école primaire ?</option>
                        <option value="Quelle était votre surnom d'enfance ?">Quelle était votre surnom d'enfance ?</option>
                        <option value="Quelle était le nom de votre animal de compagnie d'enfance ?">Quelle était le nom de votre animal de compagnie d'enfance ?</option>
                        <option value="Quelle était le nom de votre ami(e) d'enfance ?">Quelle était le nom de votre ami(e) d'enfance ?</option>
                    </select>
                </div>

                <div class="primary_input input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="node_modules/bootstrap-icons/icons/shield-lock-fill.svg" alt=""></span>
                    </div>
                    <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="reply" id="reply" value="<?= (isset($_SESSION['input']['username'])) ? $_SESSION['input']['username'] : $_SESSION['auth']['username']; ?>">
                </div>

                <div class="primary_input">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">Photo de profil</span>
                        </div>

                        <div class="custom-file">
                            <input type="file" id="avatar" name="avatar">
                        </div>
                    </div>
                </div>

                <div id="button_login">
                    <input class="btn btn-success" type="submit" value="Enregistrer">
                </div> 
        </form>
    </div>
<?php unset($_SESSION['input']);?>
    
<?php $content = ob_get_clean(); ?>

<?php $footer = 'fixed';?>

<?php require('view/template.php'); ?>