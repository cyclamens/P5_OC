<?php
namespace Forum\model;
//permet la connexion à la base de données
class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
        return $db;
    }
}