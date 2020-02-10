<?php
require_once("model/Manager.php");

class VoteManager extends Manager
{
    public function addVote($vote, $id_acteur, $id_user)
    {   
        $db = $this->dbConnect();

        $checkActeur = $db->prepare('SELECT id_acteur FROM acteur WHERE id_acteur = ?');
        $checkActeur->execute(array($id_acteur));

        if ($checkActeur->rowCount()  == 1) {

            if ($vote == 1) {

                $changeLikes = $db->prepare('SELECT id_acteur FROM vote WHERE id_acteur = ? AND id_user = ? AND vote = 2');
                $changeLikes->execute(array($id_acteur, $id_user));

                $checkLikes = $db->prepare('SELECT id_acteur FROM vote WHERE id_acteur = ? AND id_user = ?');
                $checkLikes->execute(array($id_acteur, $id_user));

                if ($changeLikes->rowcount() != 0) { 
                    $del = $db->prepare('DELETE FROM vote WHERE id_acteur = ? AND id_user = ? AND vote = 2');
                    $del->execute(array($id_acteur, $id_user));

                    $ins = $db->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUE(?, ?, ?)');
                    $ins->execute(array($id_user, $id_acteur, $vote));

                    $_SESSION['flash']['success'] = "Vous avez ajouter un j'aime à cette article !";
                    header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);
                }elseif ($checkLikes->rowCount() != 0) {
                    $del = $db->prepare('DELETE FROM vote WHERE id_acteur = ? AND id_user = ?');
                    $del->execute(array($id_acteur, $id_user));
                    header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);
                }else {
                    $ins = $db->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUE(?, ?, ?)');
                    $ins->execute(array($id_user, $id_acteur, $vote));

                    $_SESSION['flash']['success'] = "Vous avez ajouter un j'aime à cette article !";
                    header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);
                }

            }elseif ($vote == 2) {

                $changeDislikes = $db->prepare('SELECT id_acteur FROM vote WHERE id_acteur = ? AND id_user = ? AND vote = 1');
                $changeDislikes->execute(array($id_acteur, $id_user));

                $checkDisLikes = $db->prepare('SELECT id_acteur FROM vote WHERE id_acteur = ? AND id_user = ?');
                $checkDisLikes->execute(array($id_acteur, $id_user));

                if ($changeDislikes->rowcount() != 0) { 
                    $del = $db->prepare('DELETE FROM vote WHERE id_acteur = ? AND id_user = ? AND vote = 1');
                    $del->execute(array($id_acteur, $id_user));

                    $ins = $db->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUE(?, ?, ?)');
                    $ins->execute(array($id_user, $id_acteur, $vote));

                    $_SESSION['flash']['success'] = "Vous avez ajouter un je n'aime pas à cette article !";
                    header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);
                
                }elseif ($checkDisLikes->rowCount() != 0) {
                    $del = $db->prepare('DELETE FROM vote WHERE id_acteur = ? AND id_user = ?');
                    $del->execute(array($id_acteur, $id_user));
                    header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);
                }else { 
                    $ins = $db->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUE(?, ?, ?)');
                    $ins->execute(array($id_user, $id_acteur, $vote));

                    $_SESSION['flash']['success'] = "Vous avez ajouter un je n'aime pas à cette article !";
                    header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);
                }
            }
        }else {
            $_SESSION['flash']['success'] = "Vtre vote n'as pas pus êtres ajouté !";
            header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);
        }
    }

    public function getLikes($id_acteur)
    {
        $db = $this->dbConnect();

        $reqLikes = $db->prepare('SELECT vote FROM vote WHERE id_acteur = ? AND vote = 1');
        $reqLikes->execute(array($id_acteur));
        $getLikes = $reqLikes->rowCount();

        

        $reqDisLikes = $db->prepare('SELECT vote FROM vote WHERE id_acteur = ? AND vote = 2');
        $reqDisLikes->execute(array($id_acteur));
        $getDisLikes = $reqDisLikes->rowCount();

        return $getLikes;
    }

    public function getDisLikes($id_acteur)
    {
        $db = $this->dbConnect();

        $reqDisLikes = $db->prepare('SELECT vote FROM vote WHERE id_acteur = ? AND vote = 2');
        $reqDisLikes->execute(array($id_acteur));
        $getDisLikes = $reqDisLikes->rowCount();

        return $getDisLikes;
    }

    public function greenLikes($id_acteur)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT * FROM vote WHERE id_acteur = ?');
        $req->execute(array($id_acteur));
        $reqLikes = $req->fetch();

        if ($reqLikes['vote'] == 1) {
            $greenLikes = "Like_green.png";

            return $greenLikes;
        }else {
            $greenLikes = "Like.png";

            return $greenLikes;
        }
    }

    public function redDislikes($id_acteur)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT * FROM vote WHERE id_acteur = ?');
        $req->execute(array($id_acteur));
        $reqLikes = $req->fetch();

        if ($reqLikes['vote'] == 2) {
            $redDislikes = "Dislike_red.png";

            return $redDislikes;
        }else {
            $redDislikes = "Dislike.png";

            return $redDislikes;
        }
    }
}