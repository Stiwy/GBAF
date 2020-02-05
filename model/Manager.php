<?php

class Manager
{
    protected function dbConnect()
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
        }

        return $db;
    }
}