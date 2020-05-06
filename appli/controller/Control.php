<?php
namespace Forum\controller;
// Chargement des classes
require('vendor/autoload.php');
use Forum\model\{
    InscriptionManager, ConnexionManager
};


class Control
{
    //permet de s'inscrire
    public function inscription()
    {
        $inscriptionOk = new InscriptionManager();
        
        if(isset($_POST['forminscription'])) {      
            if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $mail = htmlspecialchars($_POST['mail']);
                $mail2 = htmlspecialchars($_POST['mail2']);
                $mdp = ($_POST['mdp']);
                $mdp2 = ($_POST['mdp2']);
                $pseudolength = strlen($pseudo);
                if ($pseudolength <= 255) {
                    if ($mail == $mail2) {
                        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                            $pseudoOk = $inscriptionOk->reqPseudo($pseudo);
                            $mailOk = $inscriptionOk->reqMail($mail);
                            if ($mailOk->rowCount() == 0) {
                                if ($pseudoOk->rowCount() == 0) {
                                    if ($mdp == $mdp2) {
                                        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                                    
                                        $inscriptionOk->inserMbr($pseudo, $mail, $mdp);
                                    
                                        header('Location: index.php?action=connexion');
                                    }else{
                                        throw new \Exception("Vos mots de passe ne correspondent pas !");   
                                    }
                                }else{
                                    throw new \Exception("Pseudo déjà utilisé");  
                                }
                            }else{
                                throw new \Exception("Adresse mail déjà utilisée !");  
                            }
                        }else{
                            throw new \Exception("Votre adresse mail n'est pas valide !");   
                        }
                    }else{
                        throw new \Exception("Vos adresses mail ne correspondent pas !");  
                    } 
                }else{
                    throw new \Exception("Votre pseudo ne doit pas dépasser 255 caractères !");   
                }
            
            }else{
                throw new \Exception("Tous les champs doivent être complétés !");   
            }

        }
    
        require('view/frontend/inscription.php');
    }

    //permet de se connecter
    public function login()
    {
        $connexionOk = new ConnexionManager();

        if(isset($_POST['formconnexion'])) {
            $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
            $mdpconnect = ($_POST['mdpconnect']);
            if(!empty($pseudoconnect) AND !empty($mdpconnect)) {
                $userexist = $connexionOk->connexion($pseudoconnect); 
                if($userexist -> rowCount() == 1) {
                    $userinfo = $userexist->fetch();
                    $checkPass=password_verify($_POST['mdpconnect'], $userinfo['pass']);
                    if ($checkPass) {
                        $_SESSION['pseudoconnect'] = $userinfo['pseudo'];
                        $_SESSION['idconnect'] = $userinfo['user_id'];
                        $_SESSION['adminconnect'] = $userinfo['admin'];
                        header("Location:index.php?action=forum");
                    }else{
                        throw new \Exception("Mauvais mot de passe");  
                    }
                    
                }else {
                    throw new \Exception("Mauvais pseudo !");
                }
                
            }else {
                throw new \Exception("Tous les champs doivent être complétés !");
            }
        }

        require('view/frontend/connexion.php');
    }

    //permer de se déconnecter
    function deconnect()
    {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php?action=connexion");
    }


}



/*
//permet la rédaction des chapitres
function redaction()
{
    $redactionOk = new \OpenClassrooms\Blog\Model\EditPostManager();
    if(isset($_POST['article_title'], $_POST['article_content'])) {
        if(!empty($_POST['article_title']) AND !empty($_POST['article_content'])) {
      
            $article_title = $_POST['article_title'];
            $article_content = $_POST['article_content'];
            $editOk = $redactionOk->edit($article_title, $article_content);
            if ($editOk) {
                throw new Exception("Votre article a bien été posté");  
            }else{
                throw new Exception("Article non posté"); 
            }
      
        } else {
            throw new Exception("Veuillez remplir tous les champs");
        }
    }

    require('view/backend/editpost.php');
}
//supprime un chapitre
function supprimChapter($postId)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $posts = $postManager->getPosts();
    $comments = $commentManager->adminFlagComments();
    $supChap = $postManager->supprimPost($postId);
   header("Location: index.php?action=administration");
}
//modification d'un chapitre
function editChapter($postId)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $editChap = $postManager->getPost($postId);
    
   require('view/backend/modifpost.php');
}
//modification et envoi du chapitre dans la BDD
function updateChapter($postId)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $titre_chap = $_POST['article_title'];
    $content_chap = $_POST['article_content'];
    $postId = $_GET['id'];
    $postManager->editPost($titre_chap ,$content_chap ,$postId);
    throw new Exception("Votre article a bien été modifié !");
    
}
//page d'administration
function admin()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $flagComments = $commentManager->adminFlagComments();
    require('view/backend/admin.php');
}
 
//liste les chapitres
function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}
//affiche un chapitre
function post()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}
//ajout de commentaire
function addComment($postId, $author, $comment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager(); // Création d'un objet

    $affectedLines = $commentManager->postComment($_GET['id'], $_SESSION['idconnect'], $comment);
    
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=chapitre&id=' . $_GET['id']);
    }
}
//signalement d'un commentaire
function flag($commentId)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $affectedFlag = $commentManager->flagComment($commentId);
    if ($affectedFlag) {
         header('Location: index.php?action=chapitre&id=' . $_GET['post_id']);
   
    }
    else{
        throw new Exception("commentaire non signalé !");
        
    }
          
}
//désignalement d'un commentaire
function untag($commentId)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $flagComments = $commentManager->adminFlagComments();
    $affecteduntag = $commentManager->untagComment($commentId);
    if ($affecteduntag) {
         header('Location: index.php?action=administration');
   
    }
    else{
        throw new Exception("commentaire signalé !");
        
    }
          
}
//supprime un commentaire
function deleteComment($commentId)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $deleteComments = $commentManager->adminFlagComments();
    $affectedComment = $commentManager->supprimComment($commentId);
    header('Location: index.php?action=administration');
    
}
//accueil
function home()
{
    require('view/frontend/accueil.php');
}
*/