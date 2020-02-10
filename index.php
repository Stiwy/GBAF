<?php
require('controller/frontend.php');

if (session_status() == PHP_SESSION_NONE){
    session_start();
}

if (isset($_GET['action'])){

    if ($_GET['action'] == 'addmember') {
        if (isset($_POST['cg'])) { 

            registration($_POST['name'], $_POST['firstname'], $_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['question'], $_POST['reply']);

        }else {
            $_SESSION['flash']['danger'] = "Veuillez lire et accépter les condition général";
            header('Location: index.php?action=register');
        }

    }elseif ($_GET['action'] == 'register'){
        require('view/frontend/registerView.php');

    }elseif ( $_GET['action'] == 'login'){
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            login($_POST['username'], $_POST['password']);
        }else {
            $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrecte";
            header('Location: index.php');
        }

    }elseif ($_GET['action'] == 'account') {
        if (isset($_SESSION['auth'])) {
            require('view/frontend/accountView.php');
        }else {
            $_SESSION['flash']['danger'] = "Vous devez être connecté !";
            header('Location: index.php');
        }

    }elseif ($_GET['action'] == 'logout') {
        if (isset($_SESSION['auth'])) {
            logout();
        }else {
            $_SESSION['flash']['danger'] = "Vous devez être connecté !";
            header('Location: index.php');
        }
        
    
    // ----- Reset Password -----
    
    }elseif ($_GET['action'] == 'forgot') {
        require('view/frontend/forgot_usernameView.php');

    }elseif ($_GET['action'] == 'forgot_username') { 
        forgot($_POST['username']);


    }elseif ($_GET['action'] == 'checkquestion') { 
        forgotQuestion($_SESSION['username'], $_POST['reply']);
    
    }elseif ($_GET['action'] == 'resetpassword') { 

        if ($_POST) {
            if(isset($_SESSION['username'])) {
                resetPassword($_SESSION['username'], $_POST['password'], $_POST['password_confirm']);
            }elseif(isset($_SESSION['auth'])) {
                resetPassword($_SESSION['auth'], ['username'], $_POST['password'], $_POST['password_confirm']);
            }else {
                $_SESSION['flash']['danger'] = "Veuillez vous connectez !";
                header('location: index.php');
            }

        }else {
            require('view/frontend/resetPasswordView.php');
        }
        

    // ----- Reset Password -----

    }elseif ($_GET['action'] == 'editprofil') {
        if (isset($_SESSION['auth'])) {
            if ($_POST) {
                $avatar =  $_FILES['avatar'];
                $nameavatar =  $_FILES['avatar']['name'];
                $tmp_nameavatar = $_FILES['avatar']['tmp_name'];
                $sizeavatar = $_FILES['avatar']['size'];
                
                editProfil($_POST['name'], $_POST['firstname'], $_POST['username'], $_POST['question'], $_POST['reply'], $avatar, $nameavatar, $tmp_nameavatar, $sizeavatar);
            }else {
                require('view/frontend/editProfilView.php');
            }
        }else {
            $_SESSION['flash']['danger'] = "Vous devez être connecté !";
            header('Location: index.php');
        }
        
    }elseif ($_GET['action'] == 'listacteurs') {
        if (isset($_SESSION['auth'])){
            listActeurs();
        }else {
            $_SESSION['flash']['danger'] = "Veuillez vous connectez !";
            header('location: index.php');
        }

    }elseif ($_GET['action'] == 'acteur') {
        if (isset($_SESSION['auth'])){
            if (isset($_GET['id_acteur']) && $_GET['id_acteur'] > 0) {
                acteur();
            }else {
                $_SESSION['flash']['danger'] = "Acteur inexistant !";
                header('Location: index.php');
            }
        }else {
            $_SESSION['flash']['danger'] = "Veuillez vous connectez !";
            header('location: index.php');
        }

    }elseif ($_GET['action'] == 'addvote') {
        if (isset($_GET['vote'], $_GET['id_acteur']) AND !empty($_GET['vote']) AND !empty($_GET['id_acteur'])) {
            $vote = (int) $_GET['vote'];
            $id_acteur = (int) $_GET['id_acteur'];

            vote($vote, $id_acteur, $_SESSION['auth']['id_user']);
        }else {
            header('location: index.php');
        }
    }elseif ($_GET['action'] == 'addcomment') {
        if (isset($_GET['id_acteur']) && $_GET['id_acteur'] > 0) {
            if (!empty($_POST['post'])) {
                comment($_SESSION['auth']['id_user'], $_GET['id_acteur'], $_POST['post']);
            }
            else {
                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs du formulaire !";
                header('Location: index.php?action=acteur&id_acteur=' .  $_GET['id_acteur']);
            }
        }
        else {
            $_SESSION['flash']['danger'] = "Acteur inexistant !";
            header('location: index.php');
        }
    }
    
    else {
        require('view/frontend/loginView.php');
    }
   
}else {
    if (isset($_SESSION['auth'])) {
        listActeurs();
    }else {
        require('view/frontend/loginView.php'); 
    }    
}

