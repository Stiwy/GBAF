<?php
require_once("model/Manager.php");

class MemberManager extends Manager
{
    // ----- Member connection ----- 

    public function adminAddMember($postusername, $postpassword, $postpassword_confirm, $postrole){
        if (session_status() == PHP_SESSION_NONE){session_start();}

        $errors = [];
        $input = [];

        if (empty($postusername) || !preg_match('/^[a-zA-Z0-9_]{3,25}+$/', $postusername)) {
            $errors['username'] = "Votre nom d'utilisateur n'est pas valide !";
        }else {
            $db = $this->dbConnect();

            $req = $db->prepare('SELECT id_user FROM account WHERE username = ?');
            $req->execute(array($postusername));
            $user = $req->rowCount();

            if ($user != 0) {
                $errors['username'] = "Ce nom d'utilisateur est déjà pris !";
            }else {
                $input['username'] = $postusername;
            }
        }

        if (empty($postpassword) || $postpassword != $postpassword_confirm) {
            $errors['password'] = "Vos mots de passe ne corrésponde pas !";
        }else {
            if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/', $postpassword)) {
                $errors['username'] = "Un mot de passe valide aura : </br>
                - De 8 à 15 caractères</br>
                - Au moins une lettre minuscule</br>
                - Au moins une lettre majuscule</br>
                - Au moins un chiffre</br>
                - Au moins un de ces caractères spéciaux: $ @ % * + - _ !";
                header('Location: index.php?action=register');
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['input'] = $input;
            header('Location: index.php?action=register');
        }else {
            $username = htmlspecialchars($postusername);
            $role =htmlspecialchars($postrole);

            $password = password_hash($postpassword, PASSWORD_BCRYPT);

            $member = $db->prepare('INSERT INTO account(username, password, registration_date, role) VALUES(?, ?, NOW(), ?)');
            $affectLines = $member->execute(array($username, $password, $role));

            $_SESSION['flash']['success'] = "Inscription réussie ! Un nouveau membre à était ajouté";
            header('Location: index.php?admin=addmember');

            return $affectLines;
        }
    }

    public function addMember($postname, $postfirstname, $postquestion, $postreply)
    {

        $errors = [];
        $input = [];
        
        if (empty($postname) || !preg_match('/^[a-zA-Z]{3,15}+$/', $postname)) {
            $errors['name'] = "Votre nom n'est pas valide !";
        }else {
            $input['name'] = $postname;
        }

        if (empty($postfirstname) || !preg_match('/^[a-zA-Z]{3,15}+$/', $postfirstname)) {
            $errors['firstname'] = "Votre prénom n'est pas valide !";
        }else {
            $input['firstname'] = $postfirstname;
        }

        if ($postquestion == 'default') {
            $errors['question'] = "Veuillez choisir une question secrète !";
        }

        if (empty($postreply)){
            $errors['reply'] = "Veuillez saisir une réponse !";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['input'] = $input;
            header('Location: index.php?action=register');
        }else {
            $name = htmlspecialchars($postname);
            $firstname = htmlspecialchars($postfirstname);
            $question = htmlspecialchars($postquestion);
            $reply = htmlspecialchars($postreply);

            $db = $this->dbConnect();

            $db->prepare('UPDATE account SET name = ?, firstname = ?, question = ?, reply = ? WHERE username = ?')->execute(array($name, $firstname, $question, $reply, $_SESSION['username']));

            $req = $db->prepare('SELECT * FROM account WHERE username = ?');
            $req->execute(array($_SESSION['username']));
            $user = $req->fetch();

            $_SESSION['auth'] = $user;
            unset($_SESSION['username']);

            $_SESSION['flash']['success'] = "Inscription réussie ! Bienvenue sur l'extranet de GBAF";
            header('Location: index.php');

            return $affectLines;
        }        
    }

    public function loginMember($username, $password) 
    {
        $db = $this->dbConnect();
        if (session_status() == PHP_SESSION_NONE){session_start();}

        $req = $db->prepare('SELECT * FROM account WHERE username = ?');
        $req->execute(array($username));
        $user = $req->fetch();

        if (password_verify($password, $user['password'])) {

            if ($user['name'] == 'unknown' || $user['firstname'] == 'unknown' || $user['question'] == 'unknown' || $user['reply'] == 'unknown') {
                $_SESSION['username'] = $username;
                $_SESSION['flash']['warning'] = "Pour vous connecter veuillez finir l'inscription";

                require 'view/frontend/registerView.php';
            }else {
                $_SESSION['auth'] = $user;
                $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";
                header('Location: index.php');
            }

        }else {
            $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrecte";
            header('Location: index.php');
        }

        return $user;
    }

    public function logoutMember()
    {
        session_start();
        unset($_SESSION['auth']);
        $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";
        header('location: index.php');
    }

    // ----- Forgot password -----
    
    public function forgotMember($username)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT * FROM account WHERE username = ?');
        $req->execute(array($username));
        $user = $req->rowCount();

        if ($user != 0) {
            $question = $req->fetch();

            require('view/frontend/forgot_questionView.php');

            return $question;
        }else {
            $_SESSION['flash']['danger'] = "Cette utilisateur n'existe pas !";
            header('location: index.php?action=forgot');
        }
    }

    public function forgotQuestionMember($username, $reply) 
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT * FROM account WHERE username = ?');
        $req->execute(array($username));
        $checkQuestion = $req->fetch();

        if ($checkQuestion['reply'] == $reply) {
            require('view/frontend/resetPasswordView.php');

            return $checkQuestion;
        }else {
            $_SESSION['flash']['danger'] = "Réponse incorrecte !";
            header('location: index.php?action=forgot');
        }
    }

    public function resetPasswordMember($username, $password, $password_confirm)
    {
        if (!empty($password) && $password == $password_confirm) {

            if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/', $password)) {

                $newPassword = password_hash($password, PASSWORD_BCRYPT);

                $db = $this->dbConnect();

                $db->prepare('UPDATE account SET password = ? WHERE username = ?')->execute(array($newPassword, $username));

                $_SESSION['flash']['success'] = "Votre mot de passe à été mis à jour !";
                header('Location: index.php');

                return $affectLines;

            }else {
                $_SESSION['flash']['danger'] = "Un mot de passe valide aura : </br>
                - De 8 à 15 caractères</br>
                - Au moins une lettre minuscule</br>
                - Au moins une lettre majuscule</br>
                - Au moins un chiffre</br>
                - Au moins un de ces caractères spéciaux: $ @ % * + - _ !";
                if (isset($_SESSION['auth'])) {
                    header('Location: index.php?action=editprofil');
                }elseif (isset($_SESSION['username'])) {
                    header('Location: index.php?action=forgot');
                }
            }
        }else {
            $_SESSION['flash']['danger'] = "Vos mots de passe ne corrésponde pas !";
            if (isset($_SESSION['auth'])) {
                header('Location: index.php?action=editprofil');
            }elseif (isset($_SESSION['username'])) {
                header('Location: index.php?action=forgot');
            }
            
        }
    }

    // ----- Edit profil -----
    
    public function editProfilMember($postname, $postfirstname, $postusername, $postquestion, $postreply, $avatar, $nameavatar, $tmp_nameavatar, $sizeavatar)
    {
        $errors = [];
        $input = [];

        if ($postname != $_SESSION['auth']['name']){
            if (empty($postname) || !preg_match('/^[a-zA-Z]{3,15}+$/', $postname)) {
                $errors['name'] = "Votre nom n'est pas valide !";
            }else {
                $input['name'] = $postname;
            }
        }

        if ($postfirstname != $_SESSION['auth']['firstname']) { 
            if (empty($postfirstname) || !preg_match('/^[a-zA-Z]{3,15}+$/', $postfirstname)) {
                $errors['firstname'] = "Votre prénom n'est pas valide !";
            }else {
                $input['firstname'] = $postfirstname;
            }
        }

        if ($postusername != $_SESSION['auth']['username']) { 
            if (empty($postusername) || !preg_match('/^[a-zA-Z0-9_]{3,25}+$/', $postusername)) {
                $errors['username'] = "Votre nom d'utilisateur n'est pas valide !";
            }else {
                $db = $this->dbConnect();

                $req = $db->prepare('SELECT id_user FROM account WHERE username = ?');
                $req->execute(array($postusername));
                $user = $req->rowCount();

                if ($user != 0) {
                    $errors['username'] = "Ce nom d'utilisateur est déjà pris !";
                }else {
                    $input['username'] = $postusername;
                }
            }
        }

        if ($postquestion != $_SESSION['auth']['question']) { 
            if ($postquestion == 'default') {
                $errors['question'] = "Veuillez choisir une question secrète !";
            }
        }

        if ($postreply != $_SESSION['auth']['username']) { 
            if (empty($postreply)){
                $errors['reply'] = "Veuillez saisir une réponse !";
            }
        }

        if (isset($avatar) AND !empty($nameavatar)){
            $maxsize = 2097152;
    
            if ($sizeavatar > $maxsize) {
                $errors['avatar'] = "Votre image de profil ne doit pas edépasser les 2Mo";
            }

            $extensionsUpload = strtolower(substr(strrchr($nameavatar, '.'), 1));
            $extensions = array('jpg', 'jpeg', 'gif', 'png', 'jfif', 'pdp');
            if (in_array($extensionsUpload, $extensions)) {
                 $url  = "public/image/avatar/" . $_SESSION['auth']['id_user'] . "." . $extensionsUpload;
                $result = move_uploaded_file($tmp_nameavatar, $url);
            }else {
                $errors['avatar'] = "Votre image de profil doit êtres au format jpg, jpeg, gif ou png";
            }
        }

        if (!empty($errors)) { 
            $_SESSION['errors'] = $errors;
            $_SESSION['input'] = $input;
            header('Location: index.php?action=editprofil');
        }else {
            $db = $this->dbConnect();
                    
            $name = htmlspecialchars($postname);
            $firstname = htmlspecialchars($postfirstname);
            $username = htmlspecialchars($postusername);
            $question = htmlspecialchars($postquestion);
            $reply = htmlspecialchars($postreply);

            if ($result) {
                $req = $db->prepare('UPDATE account SET avatar = :avatar WHERE id_user = :id_user');
                $req->execute(array(
                    'avatar' => $_SESSION['auth']['id_user'] . '.' . $extensionsUpload,
                    'id_user' => $_SESSION['auth']['id_user']
                ));
            }

            $db->prepare('UPDATE account SET name = ?, firstname = ?, username = ?, question = ?, reply = ? WHERE id_user = ?')->execute(array($name, $firstname, $username, $question, $reply, $_SESSION['auth']['id_user']));

            $req = $db->prepare('SELECT * FROM account WHERE id_user = ?');
            $req->execute(array($_SESSION['auth']['id_user']));
            $user = $req->fetch();

            $_SESSION['auth'] = $user;

            $_SESSION['flash']['success'] = "Votre profil à été mis à jour !";
            header('Location: index.php?action=account');
        }
    }

    public function editPasswordMember($postusername, $postpassword_old, $postpassword, $postpassword_confirm) {

        $db = $this->dbConnect();

        $username = htmlspecialchars($postusername);
        $errors = [];

        $req = $db->prepare('SELECT * FROM account WHERE username = ?');
        $req->execute(array($username));
        $user = $req->fetch();

        if (empty($postpassword_old) || !password_verify($postpassword_old, $user['password'])) {
            $errors['passwordold'] = "Mot de passe incorrecte !";
        }

        if (empty($postpassword) || $postpassword != $postpassword_confirm) {
            $errors['password'] = "Vos mots de passe ne corrésponde pas !";
        }else {
            if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/', $postpassword)) { 
                $errors["password"] = "Un mot de passe valide aura : </br>
                - De 8 à 15 caractères</br>
                - Au moins une lettre minuscule</br>
                - Au moins une lettre majuscule</br>
                - Au moins un chiffre</br>
                - Au moins un de ces caractères spéciaux: $ @ % * + - _ !";
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            require('view/frontend/editPasswordView.php');
        }else {
            $password = password_hash($postpassword, PASSWORD_BCRYPT);

            $db->prepare('UPDATE account SET password = ? WHERE username = ?')->execute(array($password ,$username));

            $_SESSION['flash']['success'] = "Mot de passe changé avec success !";
            header('Location: index.php');
        }         
    }
}