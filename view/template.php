<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="public/css/form.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/account.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/listActeur.css">
    <link rel="stylesheet" href="public/css/actorView.css">

    <!-- =====Bootstrap===== -->
    <?php require('public/js/bootstrap.php'); ?>
    <!-- =====Bootstrap===== -->
</head>
<body>
    <!-- =====Header===== -->
    <?php include ('model/include/header.php'); ?>
    <!-- =====Header===== -->

    <?= $content ?>

    <!-- =====Footer===== -->
    <section id="footer">
        <div>
            <a class="footer_1" href="#">Mention légal</a>
            <a class="footer_2" href="#">Contact</a>
        </div>  
</section>
    <!-- =====Footer===== -->
    
</body>
</html>