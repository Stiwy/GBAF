<?php
require_once('model/MemberManager.php');
require_once('model/ActeurManager.php');
require_once('model/CommentManager.php');
require_once('model/VoteManager.php');
require_once('model/Contact.php');

if (session_status() == PHP_SESSION_NONE){session_start();}

// ----- Member connection ----- 

//Index
function index(){
    require('view/frontend/loginView.php'); 
}
function listacteurs()
{
    $acteurManager = new ActeurManager();

    $acteurs = $acteurManager->getActeurs();

    require('view/frontend/listActeursView.php'); 
}

//Action = Register 
function postRegistration($name, $firstname, $username, $password, $password_confirm, $question, $reply){
    $memberManager = new MemberManager();

    $affectLines = $memberManager->addMember($name, $firstname, $username, $password, $password_confirm, $question, $reply);
}
function registration($e){

    if ($e == 1) {
        $_SESSION['flash']['danger'] = "Veuillez lire et accépter les condition général";
        require 'view/frontend/registerView.php';
    }
    require 'view/frontend/registerView.php';
}

//Action = Login
function login($username, $password) {
    $memberManager = new MemberManager();

    $user = $memberManager->loginMember($username, $password);
}

//Action = Logout
function logout(){
    $memberManager = new MemberManager();

    $logout = $memberManager->logoutMember();
}

// ----- Forgot password -----

//Action = Forgot
function indexForgot(){ 
    require 'view/frontend/forgot_usernameView.php';
}
function forgot($username){
    $memberManager = new MemberManager();

    $question = $memberManager->forgotMember($username);
}

//Action = Checkquestion
function forgotQuestion($username, $reply)
{
    $memberManager = new MemberManager();

    $checkQuestion = $memberManager->forgotQuestionMember($username, $reply);
}

//Action = Resetpassword
function resetPassword(){
    require('view/frontend/resetPasswordView.php');
}
function postResetPassword($username, $password, $password_confirm)
{
    $memberManager = new MemberManager();

    $checkQuestion = $memberManager->resetPasswordMember($username, $password, $password_confirm);
}

// ----- Edit profil -----

//Action = Editprofil 
function editProfil(){
    require('view/frontend/editProfilView.php');
}
function postEditProfil($postname, $postfirstname, $postusername, $postquestion, $postreply, $avatar, $nameavatar, $tmp_nameavatar, $sizeavatar)
{
    $memberManager = new MemberManager();

    $updtadeLines = $memberManager->editProfilMember($postname, $postfirstname, $postusername, $postquestion, $postreply, $avatar, $nameavatar, $tmp_nameavatar, $sizeavatar);
}

//Action = Editpassword
function editPassword(){
    require('view/frontend/editPasswordView.php');
}
function postEditPassword($postusername, $password_old, $password, $password_confirm) {
    $memberManager = new MemberManager();

    $affectLines = $memberManager->editPasswordMember($postusername, $password_old, $password, $password_confirm);
}

// ----- Other pages -----

//Action = Account
function account(){
    require('view/frontend/accountView.php');
}

//Action = Acteur
function acteur()
{
    $acteurManager = new ActeurManager();
    $commentManager = new CommentManager();
    $voteManager = new VoteManager();

    $acteur = $acteurManager->getActeur($_GET['id_acteur']);
    $comments = $commentManager->getComment($_GET['id_acteur']);
    $getLikes = $voteManager->getLikes($_GET['id_acteur']);
    $getDisLikes = $voteManager->getDisLikes($_GET['id_acteur']);
    $greenLikes = $voteManager->greenLikes($_GET['id_acteur']);
    $redDislikes = $voteManager->redDislikes($_GET['id_acteur']);
    $countComment = $commentManager->countComment($_GET['id_acteur']);

    require('view/frontend/acteurView.php');
}

//Action = Addcomment
function comment($id_user, $id_acteur, $post)
{
    $commentManager = new CommentManager();

    $req = $commentManager->addComment($id_user, $id_acteur, $post);
}


//Action = Addvote
function vote($vote, $id_acteur, $id_user) 
{
    $voteManager = new VoteManager();

    $addVote = $voteManager->addVote($vote, $id_acteur, $id_user); 
}

//Action = Contact
function contact(){
    
    require('view/frontend/contactUsView.php');
}
function sendMail($name, $mail, $subject, $message)
{
    $contact = new Contact();

    $mail = $contact->mail($name, $mail, $subject, $message);
}

//Action = Contact
function legal(){
    require('view/frontend/generalConditionsView.php');
}

