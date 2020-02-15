<?php $title = 'GBAF | Nos acteurs'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>
    
    <section id="actor_section" class="container">
        <div>
            <p class="actor_logo"><img src="public/image/acteur/<?=$acteur['logo']?>" alt=""></p>

            <h2><?=$acteur['acteur']?></h2>

            <p><?=$acteur['description']?></p>
        </div>
    </section>

    <section id="comment_section" class="container">
        <div class="row justify-content-between">
            <div id="title_comment">
                <h2>Commentaires (<?= $countComment ?>)</h2>
            </div>
            <div id="vote" class="row">
                <p class="col-6"><?= $getLikes ;?><a href="index.php?action=addvote&amp;vote=1&amp;id_acteur=<?= $acteur['id_acteur'] ?>"><img src="public/image/icons/<?= $greenLikes ?>" alt=""></a></p>
                <p class="col-6"><?= $getDisLikes ;?><a href="index.php?action=addvote&amp;vote=2&amp;id_acteur=<?= $acteur['id_acteur'] ?>"><img src="public/image/icons/<?= $redDislikes ?>" alt=""></a></p>
            </div>  
        </div>
        

        <div class="btn_add_comment">
            <?php if(!isset($_POST['add_comment'])): ?>
                <form method="post" class="row justify-content-end">
                    <input type="submit" id="add_comment" name="add_comment" value="Ajouter un commentaie">
                </form>
            <?php else: ?>
                <form action="index.php?action=addcomment&amp;id_acteur=<?= $acteur['id_acteur'] ?>" method="post">
                    <p>Votres avis nous intéraisse <?=$_SESSION['auth']['firstname']?> !</p>
                    <div id="form_comment">
                        <label class="form_comment_label" for="post"><img class="avatar" src="public/image/avatar/<?=$_SESSION['auth']['avatar']?>" alt=""></label>
                        <input type="text" id="post" name="post" placeholder="Ajouter un commentaire">
                    </div>
                    <input type="submit" id="btn_form_comment" value="Poster">
                </form>
            <?php endif; ?>
        </div>

        <?php while ($data = $comments->fetch()) : ?>
            <?php 
                setlocale(LC_TIME, 'fr');
                $date_add = utf8_encode(ucfirst(strftime('%A %d ' ,strtotime($data['date_add']))));
                $date_add .= utf8_encode(ucfirst(strftime('%B %Y' ,strtotime($data['date_add']))));
            ?>
            <div id="comment_list" class="row">
                <div id="comment_col_left" class="col-1">
                    <p><img class="avatar" src="public/image/avatar/<?=$data['avatar'] ?>" alt=""></p>
                    <p><?=$data['firstname'] ?></p>
                </div>
                <div id="comment_col_right" class="col-11">
                    <p id="post_comment"><?=$data['post'] ?></p>
                    <br><br>
                    <p id="comment_date">Publié le : <?= $date_add?></p>
                </div>
            </div>
        <?php endwhile ; ?>
        
    </section>
    
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>