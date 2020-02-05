<?php $title = 'GBAF | ' . $_SESSION['auth']['username']; ?>

<?php $form = 'public/css/form.css'; ?>

<?php ob_start(); ?>
    <?php require('model/include/flash.php'); ?>

    <h1 id="title_form">Votre compte</h1>
    <p id="p_form">Bonjour <?= $_SESSION['auth']['firstname']?></p>

    <a href="index.php?action=editprofil">Modifier</a >

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>