<?php
namespace Forum\model;

//chargement de la class Manager
require("vendor/autoload.php");
use Forum\model\Manager;

class CommentManager extends Manager
{
    public function getComments($topicId, $depart, $commentParPage)//Méthode qui récupére les commentaires d'un topic
    {
        
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT users.pseudo AS author, comments.comment AS content, comments.comment_id, comments.reported, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM users INNER JOIN comments ON users.user_id = comments.user_id WHERE topic_id = ? ORDER BY comments.comment_date DESC LIMIT '.$depart.','.$commentParPage);
        $comments->execute(array($topicId));
        
        return $comments;
           
    }

    public function commentTotalReq($topicId)//récupére le commentaire total lié à un topic
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT comment_id FROM comments WHERE topic_id = ?');
        
        $req->execute(array($topicId));
        return $req;

    }

    public function postComment($topicId, $author, $comment)//insére le commentaire envoyé par un auteur
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(topic_id, user_id, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($topicId, $author, $comment));

        return $affectedLines;
    }

    public function adminFlagComments()//Méthode qui récupére les commentaires signalés dans l'administrateur
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT users.pseudo AS author, comments.comment AS content, comment_id, reported, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM users INNER JOIN comments ON users.user_id = comments.user_id WHERE reported = 1 ORDER BY comment_date DESC');
        
        return $comments;
    }

    
    public function flagComment($commentId)//signale un commentaire particulier
    {
        $db = $this->dbConnect();
        $sql = $db->prepare('UPDATE comments SET reported = 1 WHERE comment_id = ?');
        $flag = $sql->execute(array($commentId));
        return $flag;
    }

    public function untagComment($commentId)//désignale un commentaire
    {
        $db = $this->dbConnect();
        $sql = $db->prepare('UPDATE comments SET reported = 0 WHERE comment_id = ?');
        $unflag = $sql->execute(array($commentId));
        return $unflag;
    }

    public function supprimComment($commentId)//supprime un commentaire
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE comment_id = ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
    }

    
}