<?php
require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function addComment($id_user, $id_acteur, $post)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT id_user FROM post WHERE id_user = ? AND id_acteur = ?');
        $req->execute(array($id_user, $id_acteur));

        if ($req->rowCount() == 0) {
            $newComment = htmlentities($post);

            $req = $db->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUE(?, ?, Now(), ?)');
            $addComment = $req->execute(array($id_user, $id_acteur, $post));

            $_SESSION['flash']['success'] = "Votre commentaire à bien était posté !";
            header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);

            return $addComment;
        }else {
            $_SESSION['flash']['danger'] = "Vous avez déjà posté un commentaire pour cette acteur !";
            header('Location: index.php?action=acteur&id_acteur=' . $id_acteur);
        }

        
    }

    public function getComment($id_acteur)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT p.id_post, p.post, DATE_FORMAT( p.date_add, \'%d/%m/%Y\') as date_add_fr, a.firstname, a.avatar FROM account a INNER JOIN post p ON p.id_user = a.id_user WHERE id_acteur = ? ORDER BY p.date_add DESC');
        $req->execute(array($id_acteur));
        
        return $req;
    }

    public function countComment($id_acteur)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT * FROM post WHERE id_acteur = ?');
        $req->execute(array($id_acteur));
        $countComment = $req->rowCount();

        return $countComment;
    }
}