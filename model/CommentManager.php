<?php
require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function addComment($id_user, $id_acteur, $post)
    {
        $db = $this->dbConnect();
        $newComment = htmlentities($post);

        $req = $db->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUE(?, ?, Now(), ?)');
        $addComment = $req->execute(array($id_user, $id_acteur, $post));

        $_SESSION['flash']['success'] = "Votre commentaire à bien était posté !";
        header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);

        return $addComment;
    }

    public function getComment($id_acteur)
    {
        $db = $this->dbConnect();
        setlocale(LC_TIME, 'fr');

        $req = $db->prepare('SELECT p.id_post, p.post, p.date_add, a.username, a.avatar FROM account a INNER JOIN post p ON p.id_user = a.id_user WHERE id_acteur = ? ORDER BY p.date_add DESC');
        $req->execute(array($id_acteur));
        $comment = $req->fetch();

        $var = utf8_encode(ucfirst(strftime('%A %d ' ,strtotime($comment['date_add']))));
        $var .= utf8_encode(ucfirst(strftime('%B %Y' ,strtotime($comment['date_add']))));
        $_SESSION['comment_date_fr'] = $var;
        
        return $req;
    }

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

                    session_start();

                    $_SESSION['vote']['Dislike'] = "Dislike_red.png";

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
}