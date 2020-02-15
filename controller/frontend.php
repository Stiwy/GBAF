<?php

require_once('model/MemberManager.php');
require_once('model/ActeurManager.php');
require_once('model/CommentManager.php');
require_once('model/VoteManager.php');

function registration($name, $firstname, $username, $password, $password_confirm, $question, $reply)
{
    $memberManager = new MemberManager();

    $affectLines = $memberManager->addMember($name, $firstname, $username, $password, $password_confirm, $question, $reply);
}

function login($username, $password) {
    $memberManager = new MemberManager();

    $user = $memberManager->loginMember($username, $password);
}

function logout(){
    $memberManager = new MemberManager();

    $logout = $memberManager->logoutMember();
}

// ----- Reset Password -----

function forgot($username)
{
    $memberManager = new MemberManager();

    $question = $memberManager->forgotMember($username);
}

function forgotQuestion($username, $reply)
{
    $memberManager = new MemberManager();

    $checkQuestion = $memberManager->forgotQuestionMember($username, $reply);
}

function resetPassword($username, $password, $password_confirm)
{
    $memberManager = new MemberManager();

    $checkQuestion = $memberManager->resetPasswordMember($username, $password, $password_confirm);
}

// ----- Reset Password -----

function editProfil($postname, $postfirstname, $postusername, $postquestion, $postreply, $avatar, $nameavatar, $tmp_nameavatar, $sizeavatar)
{
    $memberManager = new MemberManager();

    $updtadeLines = $memberManager->editProfilMember($postname, $postfirstname, $postusername, $postquestion, $postreply, $avatar, $nameavatar, $tmp_nameavatar, $sizeavatar);
}

function listActeurs()
{
    $acteurManager = new ActeurManager();

    $acteurs = $acteurManager->getActeurs();

    require ('view/frontend/listActeursView.php');
}

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

function comment($id_user, $id_acteur, $post)
{
    $commentManager = new CommentManager();

    $req = $commentManager->addComment($id_user, $id_acteur, $post);
}

function vote($vote, $id_acteur, $id_user) 
{
    $voteManager = new VoteManager();

    $addVote = $voteManager->addVote($vote, $id_acteur, $id_user); 
}

