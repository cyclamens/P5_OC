<?php
namespace Forum\model;
//chargement de la class Manager
require("vendor/autoload.php");
use Forum\model\Manager;

class PostManager extends Manager
{
    public function getCats()//Méthode récupérant toutes les catégories
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT categorie_id, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM categories ORDER BY creation_date');
        
        return $req;
    }

    
    public function getTopics()//Méthode récupérant tous les topics
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT topic_id, categorie_id, user_id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM topics ORDER BY creation_date');
        
        return $req;
    }

    public function catopic()
    {
          $db = $this->dbConnect();
          $req = $db->query('SELECT topics.categorie_id, topics.topic_id,categories.title as catitle, topics.title as toptitle, DATE_FORMAT(topics.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') as creation_date_fr, users.pseudo from topics inner join categories on categories.categorie_id = topics.categorie_id inner join users on users.user_id = topics.user_id order by topics.categorie_id asc ');
          return $req;
    }

    public function getTopic($topicId)//Méthode récupérant un topic
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT topic_id, categorie_id, user_id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM topics WHERE topic_id = ?');
        $req->execute(array($topicId));
        $post = $req->fetch();
        
        return $post;
    }

    public function getCat($catId)//Méthode affichant une catégorie en particulier
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT categorie_id, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM categories WHERE categorie_id = ?');
        $req->execute(array($catId));
        
        return $req;
    }

    public function addTopic($categorie, $userId, $title, $content)//Méthode insérant un topic
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO topics(categorie_id, user_id, title, content, creation_date) VALUES (?, ?, ?, ?, NOW())');
        $req->execute(array($categorie, $userId, $title, $content));
        
        return $req;
    }

    public function getSendTopic($topicId)//Méthode qui récupére l'auteur du topic
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT users.pseudo AS author, topics.title AS sujet FROM users INNER JOIN topics ON users.user_id = topics.user_id WHERE topic_id = ?');
        $comments->execute(array($topicId));

        return $comments;
    }



    public function supprimTopic($topicId)//supprime un topic
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM topics WHERE topic_id = ?');
        $req->execute(array($topicId));
        $post = $req->fetch();

        return $post;
    }

    public function editTopic($titre_topic , $content_topic, $topicId)//modification d'un topic
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE topics SET title = ?, content = ? WHERE topic_id = ?');
        $req->execute(array($titre_topic, $content_topic, $topicId));
        $post = $req->fetch();

        return $post;
    }

      public function supprimCat($catId)//supprime une catégorie 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM categories WHERE categorie_id = ?');
        $req->execute(array($catId));
        $post = $req->fetch();

        return $post;
    }

    public function editCat($titre_cat , $catId)//modification d'une catégorie
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE categories SET title = ? WHERE categorie_id = ?');
        $req->execute(array($titre_cat, $catId));
        $post = $req->fetch();

        return $post;
    }

}
