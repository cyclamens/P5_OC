<?php
//démarrage des sessions
session_start();
require('vendor/autoload.php');
//appel au contrôleur
require("appli/controller/Control.php");
use Forum\controller\Control;


try { // On essaie de faire des choses
    $controlOk = new Control();
    if (isset($_GET['action'])) {
        //espace inscription
        if ($_GET['action'] == 'inscription') {
            $controlOk->inscription();
        }

        //espace de connexion
        elseif ($_GET['action'] == 'connexion') {
            $controlOk->login();
        }
        
        //bouton de déconnexion
        elseif($_GET['action'] == 'deconnexion'){
            $controlOk->deconnect();
        }
        //rédaction des catégories
        elseif ($_GET['action'] == 'redaction') {
            $controlOk->redaction();
        }


        elseif($_GET['action'] == 'profil'){
            
            $controlOk->profil();
        }
            
        //modification du profil
        elseif($_GET['action'] == 'editprofil'){
            if (isset($_SESSION['idconnect'])) {
                
                $controlOk->editProfil($_SESSION['idconnect']);
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }           
                
        }

        elseif($_GET['action'] == 'validprofil'){
            if (isset($_SESSION['idconnect'])) {
                
                $controlOk->validProfil($_SESSION['idconnect']);
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }    
                
        }
         //page de rédaction des topics
        elseif($_GET['action'] == 'nouveautopic'){
            
            $controlOk->newTopic();
        }

         elseif($_GET['action'] == 'insertopic'){
            
            
            $controlOk->inserTopic();
        }
        //récupére un topic
         elseif ($_GET['action'] == 'topic') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->topic($_GET['id']);
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        //récupére une catégorie
         elseif ($_GET['action'] == 'categorie') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->cat($_GET['id']);
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        //ajout de commentaire
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                if (!empty($_POST['comment'])) {
                    $controlOk->addComment($_GET['id'], $_SESSION['idconnect'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }

         //signalement de commentaire
        elseif ($_GET['action'] == 'flagComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->flag($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }

        //suppression de commentaire
        elseif ($_GET['action'] == 'supprimeComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->deleteComment($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        //désignalement de commentaire
        elseif ($_GET['action'] == 'designal') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->untag($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        //page de l'administrateur
        elseif ($_GET['action'] == 'administration') {
            $controlOk->admin();

        }
        //suppression de topic
        elseif ($_GET['action'] == 'supprimTopic') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->supprimTopic($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        //permet la modification d'un topic
        elseif ($_GET['action'] == 'modifTopic') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->editTopic($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        //sauvegarde et envoi du topic modifié
        elseif ($_GET['action'] == 'saveTopic') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->updateTopic($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }

        //suppression d'une catégorie
        elseif ($_GET['action'] == 'supprimCategorie') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->supprimCat($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        //permet la modification d'une catégorie
        elseif ($_GET['action'] == 'modifCategorie') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->editCat($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        //sauvegarde et envoi du topic modifié
        elseif ($_GET['action'] == 'saveCategorie') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                $controlOk->updateCat($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }

        
        elseif($_GET['action'] == 'meteo'){
            
            $controlOk->meteo();
        }

    }
    
    //page d'accueil
    else {
       $controlOk-> home();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    
    $messages = $e->getMessage();//message d'erreur
    echo "<div style=\"font-family:Helvetica, Arial, sans-serif; font-size:20px; text-align:center; font-weight:bold; background-color: #B3C6C7; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 50%; color:red\">".$messages."</div>";

}