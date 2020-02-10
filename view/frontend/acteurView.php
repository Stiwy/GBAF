<?php $title = 'GBAF | Nos acteurs'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>
    
    <section id="acteur_section" class="container">
            <div id="acteur_page">
                <img src="public/image/acteur/<?=$acteur['logo']?>" alt="">

                <h2><?=$acteur['acteur']?></h2>

                <p><?=$acteur['description']?></p>
            </div>
        </section>

        <section class="container">
            
            <div class="row justify-content-between">
                <div id="title_comment">
                    <h2>Partager votre avis !</h2>
                </div>
                <div id="vote" class="row">
                    <p class="col-6"><a href="index.php?action=addvote&amp;vote=1&amp;id_acteur=<?= $acteur['id_acteur'] ?>"><img src="public/image/icons/<?= $greenLikes ?>" alt=""> <?= $getLikes ;?></a></p>
                    <p class="col-6"><a href="index.php?action=addvote&amp;vote=2&amp;id_acteur=<?= $acteur['id_acteur'] ?>"><img src="public/image/icons/<?= $redDislikes ?>" alt=""> <?= $getDisLikes ;?></a></p>
                </div>  
            </div>
            

            <form action="index.php?action=addcomment&amp;id_acteur=<?= $acteur['id_acteur'] ?>" method="post">
            
                <div id="form_comment">
                    <label class="form_comment_label" for="post"><img class="avatar" src="public/image/avatar/<?=$_SESSION['auth']['avatar']?>" alt=""></label>
                    <input type="text" id="post" name="post" placeholder="Ajouter un commentaire">
                    <input type="submit" id="btn_form_comment" value="Poster">
                </div>

            </form>

            <?php while ($data = $comments->fetch()) : ?>
                <div id="comment">
                    <div id="comment_col-1">
                        <img class="avatar" src="public/image/avatar/<?=$data['avatar'] ?>" alt="">
                        <p><?=$data['username'] ?></p>
                    </div>
                    <div id="comment_col-2">
                        <p id="post_comment"><?=$data['post'] ?></p>
                        <br><br>
                        <p id="comment_date">Publié le : <?=$_SESSION['comment_date_fr'] ?></p>
                    </div>
                </div>
            <?php endwhile ; ?>

            
        </section>
    
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>