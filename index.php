<?php
require('controller/frontend.php');

if (session_status() == PHP_SESSION_NONE){session_start();}

if (isset($_GET['action'])){

    // registerView.php
    if ($_GET['action'] == 'register'){
        if (!isset($_SESSION['auth'])) {
            if ($_POST){
                if (isset($_POST['cg'])) { 
                    registration($_POST['name'], $_POST['firstname'], $_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['question'], $_POST['reply']);
                }else {
                    $_SESSION['flash']['danger'] = "Veuillez lire et accépter les condition général";
                    header('Location: index.php?action=register');
                }
            }else {
                require('view/frontend/registerView.php');
            }
        }else {
            $_SESSION['flash']['danger'] = "Vous n'avez pas accès à cette page";
            header('Location: index.php');
        }
        
    // loginView.php 
    }elseif ( $_GET['action'] == 'login'){
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            login($_POST['username'], $_POST['password']);
        }else {
            $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrecte";
            header('Location: index.php');
        }

    // accountView.php
    }elseif ($_GET['action'] == 'account') {
        if (isset($_SESSION['auth'])) {
            require('view/frontend/accountView.php');
        }else {
            $_SESSION['flash']['danger'] = "Vous devez être connecté !";
            header('Location: index.php');
        }

    // logout (controller/frontend.php)
    }elseif ($_GET['action'] == 'logout') {
        if (isset($_SESSION['auth'])) {
            logout();
        }else {
            $_SESSION['flash']['danger'] = "Vous devez être connecté !";
            header('Location: index.php');
        }

    // forgot_usernameView.php
    }elseif ($_GET['action'] == 'forgot') {
        if (!isset($_SESSION['auth'])) {
            if ($_POST) {
                forgot($_POST['username']);
            }else {
                require('view/frontend/forgot_usernameView.php');
            }
        }else {
            $_SESSION['flash']['danger'] = "Vous n'avez pas accès à cette page";
            header('Location: index.php');
        }

    // checkquestion (controller/frontend.php)
    }elseif ($_GET['action'] == 'checkquestion') {
        if (!isset($_SESSION['auth'])) { 
            forgotQuestion($_SESSION['username'], $_POST['reply']);
        }else {
            $_SESSION['flash']['danger'] = "Vous n'avez pas accès à cette page";
            header('Location: index.php');
        }

    // resetPasswordView.php
    }elseif ($_GET['action'] == 'resetpassword') {
        if (!isset($_SESSION['auth'])) {
            if ($_POST) {
                resetPassword($_SESSION['username'], $_POST['password'], $_POST['password_confirm']);
            }else {
                require('view/frontend/resetPasswordView.php');
            }
        }else {
            $_SESSION['flash']['danger'] = "Vous n'avez pas accès à cette page";
            header('Location: index.php');
        }

    // editProfilView.php
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
    
    // editPasswordView.php
    }elseif($_GET['action'] == 'editpassword') {
        if (isset($_SESSION['auth'])) {
            if ($_POST) {
                if (isset($_SESSION['username'])){
                    editpassword($_SESSION['username'], $_POST['password_old'], $_POST['password'], $_POST['password_confirm']);
                }else {
                    header('Location: index.php');
                }
            }else {
                require('view/frontend/editPasswordView.php');
            }
        }else {
            $_SESSION['flash']['danger'] = "Vous devez être connecté !";
            header('Location: index.php');
        }
        
    // acteurView.php 
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

    // acteurView.php vote (controller/frontend.php)
    }elseif ($_GET['action'] == 'addvote') {
        if (isset($_GET['vote'], $_GET['id_acteur']) AND !empty($_GET['vote']) AND !empty($_GET['id_acteur'])) {
            $vote = (int) $_GET['vote'];
            $id_acteur = (int) $_GET['id_acteur'];

            vote($vote, $id_acteur, $_SESSION['auth']['id_user']);
        }else {
            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs du formulaire !";
            header('location: index.php');
        }

    // acteurView.php comment (controller/frontend.php)
    }elseif ($_GET['action'] == 'addcomment') {
        if (isset($_GET['id_acteur']) && $_GET['id_acteur'] > 0) {
            if (!empty($_POST['post'])) {
                comment($_SESSION['auth']['id_user'], $_GET['id_acteur'], $_POST['post']);
            }else {
                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs du formulaire !";
                header('Location: index.php?action=acteur&id_acteur=' .  $_GET['id_acteur']);
            }
        }else {
            $_SESSION['flash']['danger'] = "Acteur inexistant !";
            header('location: index.php');
        }
    // index.php -- home page
    }else {
        if (isset($_SESSION['auth'])) {
            listActeurs();
        }else {
            require('view/frontend/loginView.php'); 
        }  
    }
    
// index.php -- home page   
}else {
    if (isset($_SESSION['auth'])) {
        listActeurs();
    }else {
        require('view/frontend/loginView.php'); 
    }    
}

