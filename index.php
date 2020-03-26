<?php
require('controller/frontend.php');

if (session_status() == PHP_SESSION_NONE){session_start();}

if (isset($_GET['admin'])) {

    if ($_SESSION['auth']['role'] == "admin") {

        if ($_GET['admin'] == 'addmember'){

            if ($_POST){
                postAddMember($_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['role']);
            }else {
                addMember();
            }
        }else {
            listActeurs();
        }

    }else {
        index();
    }

}elseif (isset($_GET['action'])){

    // Is not connect
    if (!isset($_SESSION['auth'])) {

        //Action = Register 
        if ($_GET['action'] == 'register'){
            if ($_POST){
                if (isset($_POST['cg'])) { 
                    postRegistration($_POST['name'], $_POST['firstname'], $_POST['question'], $_POST['reply']);
                }else {
                    registration($e = 1);
                }
            }else {
                registration($e = 0);
            }
            
        //Action = Login
        }elseif ( $_GET['action'] == 'login'){
                login($_POST['username'], $_POST['password']);

        //Action = Forgot
        }elseif ($_GET['action'] == 'forgot') {
            if (isset($_POST['username'])) {
                forgot($_POST['username']);
            }else {
                indexForgot();
            }
        
        //Action = Checkquestion
        }elseif ($_GET['action'] == 'checkquestion') {
            forgotQuestion($_SESSION['username'], $_POST['reply']);

        //Action = Resetpassword
        }elseif ($_GET['action'] == 'resetpassword') {
            if (isset($_POST['password'])) {
                postResetPassword($_SESSION['username'], $_POST['password'], $_POST['password_confirm']);
            }else {
                resetPassword();
            }
        
        }else {
            header('Location: index.php');
        }

    // Is connect
    }elseif (isset($_SESSION['auth'])) { 

        //Action = Account
        if ($_GET['action'] == 'account') {
            account();

        //Action = Logout
        }elseif ($_GET['action'] == 'logout') {
            logout();

        //Action = Editprofil
        }elseif ($_GET['action'] == 'editprofil') {
            if ($_POST) {
                $avatar =  $_FILES['avatar'];
                $nameavatar =  $_FILES['avatar']['name'];
                $tmp_nameavatar = $_FILES['avatar']['tmp_name'];
                $sizeavatar = $_FILES['avatar']['size'];
                postEditProfil($_POST['name'], $_POST['firstname'], $_POST['username'], $_POST['question'], $_POST['reply'], $avatar, $nameavatar, $tmp_nameavatar, $sizeavatar);
            }else {
                editProfil();
            }
        
        //Action = Editpassword
        }elseif($_GET['action'] == 'editpassword') {
            if ($_POST) {
                postEditpassword($_SESSION['auth']['username'], $_POST['password_old'], $_POST['password'], $_POST['password_confirm']);
            }else {
                editPassword();
            }
            
        //Action = Acteur
        }elseif ($_GET['action'] == 'acteur') {
            if (isset($_GET['id_acteur']) && $_GET['id_acteur'] > 0) {
                acteur();
            }else {
                $_SESSION['flash']['danger'] = "Acteur inexistant !";
                header('Location: index.php');
            }

        //Action = Addvote
        }elseif ($_GET['action'] == 'addvote') {
            if (isset($_GET['vote'], $_GET['id_acteur']) AND !empty($_GET['vote']) AND !empty($_GET['id_acteur'])) {
                $vote = (int) $_GET['vote'];
                $id_acteur = (int) $_GET['id_acteur'];

                vote($vote, $id_acteur, $_SESSION['auth']['id_user']);
            }else {
                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs du formulaire !";
                header('location: index.php');
            }

        //Action = Asscomment
        }elseif ($_GET['action'] == 'addcomment') {
            if (isset($_GET['id_acteur']) && $_GET['id_acteur'] > 0) {
                if (!empty($_POST['post'])) {
                    comment($_SESSION['auth']['id_user'], $_GET['id_acteur'], $_POST['post']);
                }else {
                    $_SESSION['flash']['danger'] = "Veuillez remplir le formulaire !";
                    header('Location: index.php?action=acteur&id_acteur=' .  $_GET['id_acteur']);
                }
            }else {
                $_SESSION['flash']['danger'] = "Acteur inexistant !";
                header('location: index.php');
            }
        //Action = More
        }elseif ($_GET['action'] == 'more') {
            listActeurs();

        }else {
            header('Location: index.php');
        }
    }
}elseif (isset($_GET['page'])) { 

    //Action = Legal
    if ($_GET['page'] == 'legal') {
        legal();
    
    //Action = Contact
    }elseif ($_GET['page'] == 'contact') {
        contact();    
    }elseif ($_GET['page'] == 'sendmail') {
        sendMail($_POST['name'], $_POST['mail'], $_POST['subject'], $_POST['message']);

    }else {
        header('Location: index.php');
    }
}else {

    //Index
    if (isset($_SESSION['auth'])) {
        listActeurs();
    }else {
        index();
    }    
}

