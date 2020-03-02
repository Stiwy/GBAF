<?php
require_once("model/Manager.php");

class MemberManager extends Manager
{
    // ----- Member connection ----- 

    public function addMember($postname, $postfirstname, $postusername, $postpassword, $postpassword_confirm, $postquestion, $postreply)
    {
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if (!empty($postname) && preg_match('/^[a-zA-Z]{3,15}+$/', $postname)) {

            if (!empty($postfirstname) && preg_match('/^[a-zA-Z]{3,15}+$/', $postfirstname)) {

                if (!empty($postusername) && preg_match('/^[a-zA-Z0-9_]+$/', $postusername)) {
                    
                    $db = $this->dbConnect();

                    $req = $db->prepare('SELECT id_user FROM account WHERE username = ?');
                    $req->execute(array($postusername));
                    $user = $req->rowCount();

                    if ($user == 0) {

                        if (!empty($postpassword) && $postpassword == $postpassword_confirm) {

                            if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/', $postpassword)) { 
    
                                if ($postquestion != 'default') {
                                    
                                    if (!empty($postreply)){
                                        
                                        $name = htmlspecialchars($postname);
                                        $firstname = htmlspecialchars($postfirstname);
                                        $username = htmlspecialchars($postusername);
                                        $question = htmlspecialchars($postquestion);
                                        $reply = htmlspecialchars($postreply);
                                        $avatar = '0.png';
    
                                        $password = password_hash($postpassword, PASSWORD_BCRYPT);
    
                                        $member = $db->prepare('INSERT INTO account(name, firstname, username, password, question, reply, avatar, registration_date) VALUES(?, ?, ?, ?, ?, ?, ?, NOW())');
                                        $affectLines = $member->execute(array($name, $firstname, $username, $password, $question, $reply, $avatar));
    
                                        $_SESSION['flash']['success'] = "Inscription réussi ! Vous pouvez vous connctez";
                                        header('Location: index.php');
    
                                        return $affectLines;
    
                                    }else {
                                        $_SESSION['flash']['danger'] = "Veuillez saisir une réponse !";
                                        header('Location: index.php?action=register');
                                    }
    
                                }else {
                                    $_SESSION['flash']['danger'] = "Veuillez choisir une question secrète !";
                                    header('Location: index.php?action=register');
                                }
    
                            }else {
                                $_SESSION['flash']['danger'] = "Un mot de passe valide aura : </br>
                                - De 8 à 15 caractères</br>
                                - Au moins une lettre minuscule</br>
                                - Au moins une lettre majuscule</br>
                                - Au moins un chiffre</br>
                                - Au moins un de ces caractères spéciaux: $ @ % * + - _ !";
                                header('Location: index.php?action=register');
                            }
                        }else {
                            $_SESSION['flash']['danger'] = "Vos mots de passe ne corrésponde pas !";
                            header('Location: index.php?action=register');
                        }

                    }else {
                        $_SESSION['flash']['danger'] = "Ce nom d'utilisateur est déjà pris !";
                        header('Location: index.php?action=register');
                    }

                }else {
                    $_SESSION['flash']['danger'] = "Votre nom d'utilisateur n'est pas valide !";
                    header('Location: index.php?action=register');
                }

            }else {
                $_SESSION['flash']['danger'] = "Votre prénom n'est pas valide !";
                header('Location: index.php?action=register');
            }

        }else {
            $_SESSION['flash']['danger'] = "Votre nom n'est pas valide !";
            header('Location: index.php?action=register');
        }
    }

    public function loginMember($username, $password) 
    {
        $db = $this->dbConnect();
        session_start();

        $req = $db->prepare('SELECT * FROM account WHERE username = ?');
        $req->execute(array($username));
        $user = $req->fetch();

        if (password_verify($password, $user['password'])) {
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";
            header('Location: index.php');
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
            header('location: index.php');
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
            header('location: index.php');
        }
    }

    public function resetPasswordMember($username, $password, $password_confirm)
    {
        if (!empty($password) && $password == $password_confirm) {

            if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/', $password)) {

                $newPassword = password_hash($password, PASSWORD_BCRYPT);

                $db = $this->dbConnect();

                $db->prepare('UPDATE account SET password = ? WHERE username = ?')->execute(array($username, $newpassword));

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
        if (!empty($postname) && preg_match('/^[a-zA-Z]{3,15}+$/', $postname)) {

            if (!empty($postfirstname) && preg_match('/^[a-zA-Z]{3,15}+$/', $postfirstname)) {
                                    
                if (!empty($postreply)){

                    $db = $this->dbConnect();
                    
                    $name = htmlspecialchars($postname);
                    $firstname = htmlspecialchars($postfirstname);
                    $username = htmlspecialchars($postusername);
                    $question = htmlspecialchars($postquestion);
                    $reply = htmlspecialchars($postreply);

                    if (isset($avatar) AND !empty($nameavatar)) {

                        $maxsize = 2097152;
                        $extensions = array('jpg', 'jpeg', 'gif', 'png', 'jfif');
                        if ($sizeavatar <= $maxsize) {

                            $extensionsUpload = strtolower(substr(strrchr($nameavatar, '.'), 1));
                            if (in_array($extensionsUpload, $extensions)) {
                                $url  = "public/image/avatar/" . $_SESSION['auth']['id_user'] . "." . $extensionsUpload;
                                $result = move_uploaded_file($tmp_nameavatar, $url);
                                if ($result) {
                                    $req = $db->prepare('UPDATE account SET avatar = :avatar WHERE id_user = :id_user');
                                    $req->execute(array(
                                        'avatar' => $_SESSION['auth']['id_user'] . '.' . $extensionsUpload,
                                        'id_user' => $_SESSION['auth']['id_user']
                                    ));

                                    $_SESSION['flash']['success'] = "Votre profil à été mis à jour !";
                                    header('Location: index.php?action=account');

                                }else {
                                    $_SESSION['flash']['danger'] = "Une érreur c'est produite l'ors de l'importation du fichier !";
                                    header('Location: index.php?action=editprofil');
                                }

                            }else {
                                $_SESSION['flash']['danger'] = "Votre image de profil doit êtres au format jpg, jpeg, gif ou png !";
                                header('Location: index.php?action=editprofil');
                            }

                        }else {
                            $_SESSION['flash']['danger'] = "Votre image de profil ne doit pas edépasser les 2Mo !";
                            header('Location: index.php?action=editprofil');
                        }
                    }

                    if ($_SESSION['auth']['username'] == $username) {
                        $db->prepare('UPDATE account SET name = ?, firstname = ?, question = ?, reply = ? WHERE id_user = ?')->execute(array($name, $firstname, $question, $reply, $_SESSION['auth']['id_user']));
                        
                        $req = $db->prepare('SELECT * FROM account WHERE id_user = ?');
                        $req->execute(array($_SESSION['auth']['id_user']));
                        $user = $req->fetch();

                        $_SESSION['auth'] = $user;

                        $_SESSION['flash']['success'] = "Votre profil à été mis à jour !";
                        header('Location: index.php?action=account');
                    }else {
                        if (!empty($postusername) && preg_match('/^[a-zA-Z0-9_]+$/', $postusername)) {
                    
                            $db = $this->dbConnect();
        
                            $req = $db->prepare('SELECT id_user FROM account WHERE username = ?');
                            $req->execute(array($username));
                            $user = $req->rowCount();
        
                            if ($user == 0) {
                                $db->prepare('UPDATE account SET name = ?, firstname = ?, username = ?, question = ?, reply = ? WHERE id_user = ?')->execute(array($name, $firstname, $username, $question, $reply, $_SESSION['auth']['id_user']));
                        
                                $req = $db->prepare('SELECT * FROM account WHERE id_user = ?');
                                $req->execute(array($_SESSION['auth']['id_user']));
                                $user = $req->fetch();

                                $_SESSION['auth'] = $user;

                                $_SESSION['flash']['success'] = "Votre profil à été mis à jour !";
                                header('Location: index.php?action=account');
                            }else {
                                $_SESSION['flash']['danger'] = "Ce nom d'utilisateur est déjà pris !";
                                header('Location: index.php?action=editprofil');
                            }
        
                        }else {
                            $_SESSION['flash']['danger'] = "Votre nom d'utilisateur n'est pas valide !";
                            header('Location: index.php?action=editprofil');
                        }
                    }

                }else {
                    $_SESSION['flash']['danger'] = "Veuillez saisir une réponse !";
                    header('Location: index.php?action=editprofil');
                }
            }else {
                $_SESSION['flash']['danger'] = "Votre prénom n'est pas valide !";
                header('Location: index.php?action=editprofil');
            }

        }else {
            $_SESSION['flash']['danger'] = "Votre nom n'est pas valide !";
            header('Location: index.php?action=editprofil');
        }
    }

    public function editPasswordMember($postusername, $postpassword_old, $postpassword, $postpassword_confirm) {

        $db = $this->dbConnect();

        $username = htmlspecialchars($postusername);

        $req = $db->prepare('SELECT * FROM account WHERE username = ?');
        $req->execute(array($username));
        $user = $req->fetch();

        if (!empty($postpassword_old) && password_verify($postpassword_old, $user['password'])) {

            if (!empty($postpassword) && $postpassword == $postpassword_confirm) {

                if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/', $postpassword)) { 

                    $password = password_hash($postpassword, PASSWORD_BCRYPT);

                    $db->prepare('UPDATE account SET password = ? WHERE username = ?')->execute(array($username, $password));

                    $_SESSION['flash']['success'] = "Mot de passe changé avec success !";
                    header('Location: index.php');

                    return $affectLines;

                }else {
                    $_SESSION['flash']['danger'] = "Un mot de passe valide aura : </br>
                    - De 8 à 15 caractères</br>
                    - Au moins une lettre minuscule</br>
                    - Au moins une lettre majuscule</br>
                    - Au moins un chiffre</br>
                    - Au moins un de ces caractères spéciaux: $ @ % * + - _ !";
                    header('Location: index.php?action=editpassword');
                }
            }else {
                $_SESSION['flash']['danger'] = "Vos mots de passe ne corrésponde pas !";
                header('Location: index.php?action=editpassword');
            }
        }else {
            $_SESSION['flash']['danger'] = "Mot de passe incorrect !";
            header('Location: index.php?action=editpassword');
        }
    }
}