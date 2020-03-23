<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>

    <link rel="shortcut icon" type="image/png" href="public/image/logo_gbaf.png"/>

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/account.css">
    <link rel="stylesheet" href="public/css/acteurView.css">
    <link rel="stylesheet" href="public/css/contactUs.css">
    <link rel="stylesheet" href="public/css/footer.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/listActeur.css">
    <link rel="stylesheet" href="public/css/style.css">

    <!-- =====Bootstrap===== -->
    <?php require('public/js/bootstrap.php'); ?>
    <!-- =====Bootstrap===== -->
</head>
<body>
    <!-- =====Header===== -->
    <?php include ('model/include/header.php'); ?>

    <?= $content ?>

    <footer class="<?= $footer ?>">
        <a class="footer_1" href="index.php?page=legal">Mention légal</a>
        <a class="footer_2" href="index.php?page=contact">Contact</a>
    </footer>
    
</body>
</html>