<?php
require_once("model/Manager.php");

class ActeurManager extends Manager
{
    public function getActeurs()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT * FROM acteur ORDER BY id_acteur DESC');

        return $req;
    }

    public function getActeur($id_acteur)
    {
        $db =$this->dbConnect();

        $req = $db->prepare('SELECT * FROM acteur WHERE id_acteur = ?');
        $req -> execute(array($id_acteur)); 
        $acteur = $req->fetch();

        return $acteur;
    }
}