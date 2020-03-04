<?php $title = 'GBAF | S\'inscrire';?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>
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
    <div class="my-5">

        <h1 class="primary_h1">Editer mon profil</h1>
        <h3 class="primary_h3">Modifier votre profil utilisateur</h3>

        <div class="ml-5 mt-3 mb-3">
            <a class="btn btn-warning btn-sm" href="index.php?action=editpassword" role="button">Modifier le mot de passe</a>
        </div>

        <form method="post" action="index.php?action=editprofil" enctype="multipart/form-data">
            <div class="primary_input">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-info-fill" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533l1.002-4.705zM10 7.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg></span>
                        </div>
                        <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="name" id="name" value="<?= $_SESSION['auth']['name']?>">
                    </div>
                </div>

                <div class="primary_input">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-info-fill" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533l1.002-4.705zM10 7.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg></span>
                        </div>
                        <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="firstname" id="firstname" value="<?= $_SESSION['auth']['firstname']?>">
                    </div>
                </div>

                <div class="primary_input">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-person-fill" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 16s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H5zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg></span>
                        </div>
                        <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="username" id="username" value="<?= $_SESSION['auth']['username']?>">
                    </div>
                </div>

                <div class="primary_input">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-question-square-fill" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H4zm4.57 6.033H7.25C7.22 6.147 8.68 5.5 10.006 5.5c1.397 0 2.673.73 2.673 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.355H9.117l-.007-.463c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.901 0-1.358.603-1.358 1.384zm1.251 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z" clip-rule="evenodd"></path></svg></span>
                        </div>
                        <select name="question" id="question" class="custom-select custom-select-md" required>
                            <option selected value="<?= $_SESSION['auth']['question']?>"><?= $_SESSION['auth']['question']?></option>
                            <option value="Quelle était le nom de votre école primaire ?">Quelle était le nom de votre école primaire ?</option>
                            <option value="Quelle était votre surnom d'enfance ?">Quelle était votre surnom d'enfance ?</option>
                            <option value="Quelle était le nom de votre animal de compagnie d'enfance ?">Quelle était le nom de votre animal de compagnie d'enfance ?</option>
                            <option value="Quelle était le nom de votre ami(e) d'enfance ?">Quelle était le nom de votre ami(e) d'enfance ?</option>
                        </select>
                    </div>
                </div>

                <div class="primary_input">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><svg class="bi bi-shield-lock-fill" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.187 3.025C8.23 2.749 9.337 2.5 10 2.5c.662 0 1.77.249 2.813.525a61.1 61.1 0 012.772.815c.527.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.368 9.365a11.19 11.19 0 01-2.417 2.3 6.942 6.942 0 01-1.007.586c-.27.124-.558.225-.796.225s-.527-.101-.796-.225a6.908 6.908 0 01-1.007-.586 11.192 11.192 0 01-2.418-2.3c-1.611-2.058-2.94-5.168-2.367-9.365A1.454 1.454 0 014.415 3.84a61.105 61.105 0 012.772-.815zm3.328 6.884a1.5 1.5 0 10-1.06-.011.5.5 0 00-.044.136l-.333 2a.5.5 0 00.493.582h.835a.5.5 0 00.493-.585l-.347-2a.501.501 0 00-.037-.122z" clip-rule="evenodd"></path></svg></span>
                        </div>
                        <input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="reply" id="reply" value="<?= $_SESSION['auth']['reply']?>">
                    </div>
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
    
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>