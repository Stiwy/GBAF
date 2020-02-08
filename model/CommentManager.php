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
}