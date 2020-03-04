<?php $title = 'GBAF | Nos acteurs'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <section class="section_acteursList">
        
        <!-- GBAF intro -->
        <section id="gbaf">
            <div>
                <h1 class="primary_h1">Le Groupement Banque Assurance Française</h1>

                <p><?php
                   if (isset($_GET['action']) && ($_GET['action'] == 'more')) {
                    echo "Le Groupement Banque Assurance Français​ (GBAF) est une fédération  représentant les 6 grands groupes français : BNP Paribas, BPCE, Crédit Agricole, Crédit Mutuel, CIC, Société Générale, La Banque Postale. <br><span><br>Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler  de la même façon pour gérer près de 80 millions de comptes sur le territoire  national. 
                    Le GBAF est le représentant de la profession bancaire et des assureurs sur tous  les axes de la réglementation financière française. Sa mission est de promouvoir  l'activité bancaire à l'échelle nationale. 
                    C’est aussi un interlocuteur privilégié des  pouvoirs publics.</span>";
                   }else {
                    echo "Le Groupement Banque Assurance Français​ (GBAF) est une fédération  représentant les 6 grands groupes français : BNP Paribas, BPCE, Crédit Agricole, Crédit Mutuel, CIC, Société Générale, La Banque Postale. <br><span class=\"d-none d-lg-inline\"><br>Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler  de la même façon pour gérer près de 80 millions de comptes sur le territoire  national. 
                    Le GBAF est le représentant de la profession bancaire et des assureurs sur tous  les axes de la réglementation financière française. Sa mission est de promouvoir  l'activité bancaire à l'échelle nationale. 
                    C’est aussi un interlocuteur privilégié des  pouvoirs publics.</span><a class=\"d-lg-none d-md-inline\" href=\"index.php?action=more\">En savoir plus...</a>";
                   }
                ?></p>   
            </div>

            <div id="banner">
                <img src="public/image/GBAF_banner.png" alt="Banière GBAF">
            </div>
        </section>

        <section id="acteursList">
            <h2>Retrouvez nos acteurs et nos partenaires !</h2>

            <p>Informer vous sur nos acteurs et sur nos partenaires présent ci-dessous, vous y trouverai des informations portant sur des produits bancaires et  des financeurs</p>

            <?php while ($data = $acteurs->fetch()) : ?>

                <div id="while_acteur_block" class="row align-items-center">
                    <div class="col-12 col-md-4">
                        <img id="while_acteur_picture" src="public/image/acteur/<?=$data['logo']?>" alt="Image de l'acteur">
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="row">
                            <div class="col-12">
                                <h3 id="while_acteur_h3"><?=$data['acteur']?></h3>

                                <p id="while_acteur_p"><?= substr($data['description'], 0, 205)?>...<a href="index.php?action=acteur&amp;id_acteur=<?= $data['id_acteur'] ?>">[plus]</a></p>
                            </div>
                            <div class="offset-lg-8 col-lg-4 offset-6 col-6">
                                <p><a id="btn_acteurlist" href="index.php?action=acteur&amp;id_acteur=<?= $data['id_acteur'] ?>">Lire la suite</a></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            <?php endwhile ; ?>
        </section>
    </section>
    
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>