<?php

require_once('model/MemberManager.php');

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
