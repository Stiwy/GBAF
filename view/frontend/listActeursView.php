<?php $title = 'GBAF | Nos acteurs'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 id="title_form">Nos acteurs</h1>
    <p id="sub_title">...</p>

    <section class="container">
        <?php while ($data = $acteurs->fetch()) : ?>
            <div id="acteur">
                <h2><?=$data['acteur']?></h2>

                <p><img src="public/image/acteur/<?=$data['logo']?>" alt="Image de l'acteur"></p>

                <p><?=$data['description']?><a href="index.php?action=acteur&amp;id_acteur=<?= $data['id_acteur'] ?>">[En savoir plus...]</a></p>
            </div>
        <?php endwhile ; ?>
    </section>
    
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>