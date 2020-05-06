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
        /*
        //zone de rédaction des chapitres
        elseif ($_GET['action'] == 'redaction') {
            redaction();
        }
        //permet de lister tous les chapitres
        elseif ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        //affiche un chapitre en particulier
        elseif ($_GET['action'] == 'chapitre') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                post();
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
                    addComment($_GET['id'], $_SESSION['idconnect'], $_POST['comment']);
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
                flag($_GET['id']);
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
                deleteComment($_GET['id']);
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
                untag($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        //page de l'administrateur
        elseif ($_GET['action'] == 'administration') {
            admin();

        }
        //suppression de chapitre
        elseif ($_GET['action'] == 'supprimeChapitre') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                supprimChapter($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        //permet la modification d'un chapitre
        elseif ($_GET['action'] == 'modifChapitre') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                editChapter($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        //sauvegarde et envoi du chapitre modifié
        elseif ($_GET['action'] == 'savepost') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] < 100) {
                $_GET['id'] = (int)$_GET['id'];
                updateChapter($_GET['id']);
            }
        
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }*/

    }
    /*
    //page d'accueil
    else {
        home();
    }*/
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    
    $messages = $e->getMessage();//message d'erreur
    echo "<div style=\"font-family:Helvetica, Arial, sans-serif; font-size:20px; text-align:center; font-weight:bold; background-color: #B3C6C7; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 50%; color:red\">".$messages."</div>";

}