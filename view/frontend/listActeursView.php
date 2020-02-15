<?php $title = 'GBAF | Nos acteurs'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <section class="section_listActeurs">
        <section class="section_listActeurs_1">

            <div>
                <h1>Le Groupement Banque Assurance Française</h1>

                <p>Le Groupement Banque Assurance Français​ (GBAF) est une fédération  représentant les 6 grands groupes français : BNP Paribas, BPCE, Crédit Agricole, Crédit Mutuel, CIC, Société Générale, La Banque Postale. <br>Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler  de la même façon pour gérer près de 80 millions de comptes sur le territoire  national. Le GBAF est le représentant de la profession bancaire et des assureurs sur tous  les axes de la réglementation financière française. Sa mission est de promouvoir  l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des  pouvoirs publics.</p>
            
            </div>

            <div id="banner">

                <h2 id="GBAF_title_banner">GBAF</h2>

                <img id="GBAF_banner" src="public/image/GBAF_banner.png" alt="Banière GBAF">
            </div>
        </section>

        <section class="section_listActeurs_2">
            <h2>Retrouvez nos acteurs et nos partenaires !</h2>

            <p>Informer vous sur nos acteurs et sur nos partenaires présent ci-dessous, vous y trouverai des informations portant sur des produits bancaires et  des financeurs</p>

            <?php while ($data = $acteurs->fetch()) : ?>
                <div id="while_actor_block" class="row">
                    <div class="col-md-3 align-self-center">
                        <img id="while_actor_picture" src="public/image/acteur/<?=$data['logo']?>" alt="Image de l'acteur">
                    </div>

                    <div class="col-md-8">
                        <h3><?=$data['acteur']?></h3>

                        <p><?= substr($data['description'], 0, 105)?>...<a href="index.php?action=acteur&amp;id_acteur=<?= $data['id_acteur'] ?>">[plus]</a></p>
                    </div>

                    <div class="col-md-1 align-self-end">
                        <p><a id="btn_actorlist" href="index.php?action=acteur&amp;id_acteur=<?= $data['id_acteur'] ?>">Lire la suite</a></p>
                    </div>  
                </div>
                
            <?php endwhile ; ?>
        </section>
    </section>

    
    
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>