<?php
namespace Forum\controller;

// Chargement des classes
require('vendor/autoload.php');
use Forum\model\{
    InscriptionManager, ConnexionManager, editprofilManager, EditCatManager, PostManager, CommentManager
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
                        $_SESSION['mailconnect'] = $userinfo['mail'];
                        $_SESSION['avatarconnect'] = $userinfo['avatar'];
                        header("Location:index.php?action=meteo");
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

    //rédaction des catégories
    public function redaction()
    {
        $redactionOk = new EditCatManager();

        if(isset($_POST['cat_title'])) {
            if(!empty($_POST['cat_title'])) {
      
                $title = htmlspecialchars($_POST['cat_title']);
            
                $editOk = $redactionOk->edit($title);
                if ($editOk) {
                    throw new \Exception("Votre catégorie a bien été postée");  
                }else{
                    throw new \Exception("Catégorie non postée"); 
                }
      
            } else {
                throw new \Exception("Veuillez remplir tous les champs");
            }
        }

        require('view/backend/editcategorie.php');
    }


    //permer de se déconnecter
    public function deconnect()
    {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php?action=connexion");
    }
    //page de profil
    public function profil()
    {
        require('view/frontend/profil.php');
    }

    //page d'édition de profil
    public function editProfil($userId)
    {

        $editionprofilOk = new editprofilManager();
        
        if(isset($_SESSION['idconnect'])) {
            $requser = $editionprofilOk->reqUser($_SESSION['idconnect']);
            $user = $requser->fetch();
            
           
            require('view/frontend/editprofil.php');
        }
    }

    //page de traitement de la modification du profil
    public function validProfil($userId)
    {

        $editionprofilOk = new editprofilManager();
        
        if(isset($_SESSION['idconnect'])) {
            $requser = $editionprofilOk->reqUser($_SESSION['idconnect']);
            $user = $requser->fetch();
           
            //modification du pseudo
            if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo']) {
                $newpseudo = htmlspecialchars($_POST['newpseudo']);
                $reqpseudo = $editionprofilOk->reqPseudo($newpseudo, $_SESSION['idconnect']);
                header('Location: index.php?action=profil');
            }
            //modification du mail
            if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail']) {
                $newmail = htmlspecialchars($_POST['newmail']);
                $reqmail = $editionprofilOk->reqMail($newmail, $_SESSION['idconnect']);
               
                header('Location: index.php?action=profil');
            }
            
            //modification du mot de passe
            if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
                $mdp1 = $_POST['newmdp1'];
                $mdp2 = $_POST['newmdp2'];
                if($mdp1 == $mdp2) {
                    $mdp1 = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);
                    $editionprofilOk->reqMdp($mdp1, $_SESSION['idconnect']);
                    header('Location: index.php?action=profil');
                } else {
                    throw new \Exception("Vos deux mdp ne correspondent pas !");
                        
                }
            }

            //Télécharger son avatar

            if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
                $tailleMax = 2097152;//Taille de la photo(2097152 octets ->correspond à 2Mo)
                $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');//Les extensions souhaitées
                if($_FILES['avatar']['size'] <= $tailleMax) {
                    $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));//vérification de l'extension
                    if(in_array($extensionUpload, $extensionsValides)) {//pour savoir est ce que le fichier upload intégre bien les extensions valides
                        $chemin = "public/membres/avatars/".$_SESSION['idconnect'].".".$extensionUpload;//chemin vers lequel sera uplooad notre photo
                        $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                        var_dump($resultat);
                        if($resultat) {
                            
                            $avatar = $_SESSION['idconnect'].".".$extensionUpload;
                            $userId = $_SESSION['idconnect'];
                            $avatarOK = $editionprofilOk->reqAvatar($avatar, $userId);
                            header('Location: index.php?action=profil');
                        }else{
                            throw new \Exception("Erreur durant l'importation de votre photo de profil");
                               
                        }
                    }else{
                        throw new \Exception("Votre photo de profil doit être au format jpg, jpeg, gif ou png");
                        
                    }
                }else{
                    throw new \Exception("Votre photo de profil ne doit pas dépasser 2Mo");
                   
                }
            }

            require('view/frontend/editprofil.php');
        }
    }

    //page météo
    public function meteo()
    {
        require('view/frontend/meteo.php');
    }

    //page de rédaction des topics
    public function newTopic()
    {
        $postManager = new PostManager();
        $post = $postManager->getCats();


        require('view/frontend/newTopic.php');
    }

    
    //page de traitement et d'insertion topics
    public function inserTopic()
    {
        $postManager = new PostManager();
        
        if(isset($_POST['tsubmit'])) {
            if(isset($_POST['tsujet'],$_POST['tcontenu'])) {
                $titre = htmlspecialchars($_POST['tsujet']);
                $content = htmlspecialchars($_POST['tcontenu']);
                $cat = $_POST['catSelect'];
                
                if(!empty($titre) AND !empty($content)) {
                    if(strlen($titre) <= 70) {
                        $inser = $postManager->addTopic($cat, $_SESSION['idconnect'], $titre, $content);
                        header('location: index.php?action=nouveautopic');

                    }else{
                        throw new Exception("Votre sujet ne peut pas dépasser 70 caractéres !");
                        
                    }    

                }else{
                    throw new \Exception("Veuillez compléter tous les champs !");
                    
                }    

            }   
        }
    }

    //récupére un topic
    public function topic($topicId)
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $post = $postManager->getTopic($_GET['id']);
        $sendTopic = $postManager->getSendTopic($_GET['id']);
        $catopic = $postManager->catopic();
        
        $comment = $commentManager->commentTotalReq($topicId);

        $commentParPage = 3;
        $commentTotal = $comment->rowCount();
        $pageTotale = ceil($commentTotal/$commentParPage);
        
        if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pageTotale) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
        }
        
        $depart = ($pageCourante-1)*$commentParPage;//offset

        $comments = $commentManager->getComments($_GET['id'], $depart, $commentParPage);
        
        require('view/frontend/topicView.php');
    }


    //récupére une catégorie
    public function cat($catId)
    {
        $postManager = new PostManager();
        $post = $postManager->getCat($_GET['id']);
        
        require('view/frontend/catView.php');
    }

    //ajout de commentaire
    public function addComment($topicId, $author, $comment)
    {
        $commentManager = new CommentManager(); 

        $affectedLines = $commentManager->postComment($_GET['id'], $_SESSION['idconnect'], $comment);
    
        if ($affectedLines === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=topic&id=' . $_GET['id']);
        }
    }

    //signalement d'un commentaire
    public function flag($commentId)
    {
        $commentManager = new CommentManager();
        $affectedFlag = $commentManager->flagComment($commentId);
        if ($affectedFlag) {
            header('Location: index.php?action=topic&id=' . $_GET['topic_id']);
   
        }
        else{
            throw new \Exception("commentaire non signalé !");
        
        }
          
    }

    //page d'administration
    public function admin()
    {
        $postManager = new PostManager(); 
        $posts = $postManager->getTopics();
        $cats = $postManager->getCats();
        $commentManager = new CommentManager();
        $flagComments = $commentManager->adminFlagComments();

        require('view/backend/adminView.php');
    }

    //désignalement d'un commentaire
    public function untag($commentId)
    {
        $postManager = new PostManager(); 
        $posts = $postManager->getTopics();
        $commentManager = new CommentManager();
        $flagComments = $commentManager->adminFlagComments();
        $affecteduntag = $commentManager->untagComment($commentId);
        if ($affecteduntag) {
            header('Location: index.php?action=administration');
   
        }
        else{
            throw new \Exception("commentaire signalé !");
        
        }
          
    }

    //supprime un commentaire
    public function deleteComment($commentId)
    {
        $postManager = new PostManager(); 
        $posts = $postManager->getTopics();
        $commentManager = new CommentManager();
        $deleteComments = $commentManager->adminFlagComments();
        $affectedComment = $commentManager->supprimComment($commentId);
        header('Location: index.php?action=administration');
    
    }

    //supprime un topic
    public function supprimTopic($topicId)
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $posts = $postManager->getTopics();
        $comments = $commentManager->adminFlagComments();
        $supTopic = $postManager->supprimTopic($topicId);

        header("Location: index.php?action=administration");
    }

    //modification d'un topic
    public function editTopic($topicId)
    {
        $postManager = new PostManager();
        $editTopic = $postManager->getTopic($topicId);
    
        require('view/backend/modifTopic.php');
    }

    //modification et envoi du topic dans la BDD
    public function updateTopic($topicId)
    {
        $postManager = new PostManager();
        $titre_topic = $_POST['topic_title'];
        $content_topic = $_POST['topic_content'];
        $topicId = $_GET['id'];
        $postManager->editTopic($titre_topic ,$content_topic ,$topicId);

        throw new \Exception("Votre topic a bien été modifié !");
    
    }

    //supprime une catégorie
    public function supprimCat($catId)
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $posts = $postManager->getCats();
        $comments = $commentManager->adminFlagComments();
        $supCat = $postManager->supprimCat($catId);

        header("Location: index.php?action=administration");
    }

    //modification d'une catégorie
    public function editCat($catId)
    {
        $postManager = new PostManager();
        $editCat = $postManager->getCat($catId);
    
        require('view/backend/modifCat.php');
    }

    //modification et envoi d'une catégorie dans la BDD
    public function updateCat($catId)
    {
        $postManager = new PostManager();
        $titre_cat = $_POST['cat_title'];
        
        $catId = $_GET['id'];
        $postManager->editCat($titre_cat , $catId);

        throw new \Exception("Votre Catégorie a bien été modifiée !");
    
    }

    //accueil
    public function home()
    {
        $postManager = new PostManager(); 
        $posts = $postManager->getCats(); 
        $topics = $postManager->getTopics();
        $catopic = $postManager->catopic();
       
        require('view/frontend/accueil.php');
    }

}

