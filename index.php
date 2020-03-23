<?php
require('controller/frontend.php');

if (session_status() == PHP_SESSION_NONE){session_start();}

if (isset($_GET['action'])){

    // Is not connect
    if (!isset($_SESSION['auth'])) {

        // registerView.php
        if ($_GET['action'] == 'register'){
            if ($_POST){
                if (isset($_POST['cg'])) { 
                    registration($_POST['name'], $_POST['firstname'], $_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['question'], $_POST['reply']);
                }else {
                    $_SESSION['errors']['cg'] = "Veuillez lire et accépter les condition général";
                    header('Location: index.php?action=register');
                }
            }else {
                require('view/frontend/registerView.php');
            }
            
        // loginView.php 
        }elseif ( $_GET['action'] == 'login'){
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                login($_POST['username'], $_POST['password']);
            }else {
                $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrecte";
                header('Location: index.php');
            }

        // forgot_usernameView.php
        }elseif ($_GET['action'] == 'forgot') {
            if ($_POST) {
                forgot($_POST['username']);
            }else {
                require('view/frontend/forgot_usernameView.php');
            }

        // checkquestion (controller/frontend.php)
        }elseif ($_GET['action'] == 'checkquestion') {
            forgotQuestion($_SESSION['username'], $_POST['reply']);

        // resetPasswordView.php
        }elseif ($_GET['action'] == 'resetpassword') {
            if ($_POST) {
                resetPassword($_SESSION['username'], $_POST['password'], $_POST['password_confirm']);
            }else {
                require('view/frontend/resetPasswordView.php');
            }
        
        }else {
            header('Location: index.php');
        }

    // Is connect
    }elseif (isset($_SESSION['auth'])) { 

        // accountView.php
        if ($_GET['action'] == 'account') {
                require('view/frontend/accountView.php');

        // logout (controller/frontend.php)
        }elseif ($_GET['action'] == 'logout') {
                logout();er('Location: index.php');

        // editProfilView.php
        }elseif ($_GET['action'] == 'editprofil') {
            if ($_POST) {
                $avatar =  $_FILES['avatar'];
                $nameavatar =  $_FILES['avatar']['name'];
                $tmp_nameavatar = $_FILES['avatar']['tmp_name'];
                $sizeavatar = $_FILES['avatar']['size'];
                editProfil($_POST['name'], $_POST['firstname'], $_POST['username'], $_POST['question'], $_POST['reply'], $avatar, $nameavatar, $tmp_nameavatar, $sizeavatar);
            }else {
                require('view/frontend/editProfilView.php');
            }
        
        // editPasswordView.php
        }elseif($_GET['action'] == 'editpassword') {
            if ($_POST) {
                if (isset($_SESSION['username'])){
                    editpassword($_SESSION['username'], $_POST['password_old'], $_POST['password'], $_POST['password_confirm']);
                }else {
                    header('Location: index.php');
                }
            }else {
                require('view/frontend/editPasswordView.php');
            }
            
        // acteurView.php 
        }elseif ($_GET['action'] == 'acteur') {
            if (isset($_GET['id_acteur']) && $_GET['id_acteur'] > 0) {
                acteur();
            }else {
                $_SESSION['flash']['danger'] = "Acteur inexistant !";
                header('Location: index.php');
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

        }elseif ($_GET['action'] == 'more') {
            listActeurs();

        }else {
            header('Location: index.php');
        }
    }
}elseif (isset($_GET['page'])) { 
    if ($_GET['page'] == 'legal') {
        require('view/frontend/generalConditionsView.php');

    }elseif ($_GET['page'] == 'contact') {
        require('view/frontend/contactUsView.php');

    }elseif ($_GET['page'] == 'sendmail') {
        sendMail($_POST['name'], $_POST['mail'], $_POST['subject'], $_POST['category'], $_POST['message']);
    }else {
        header('Location: index.php');
    }
}else {
    if (isset($_SESSION['auth'])) {
        listActeurs();
    }else {
        require('view/frontend/loginView.php'); 
    }    
}

