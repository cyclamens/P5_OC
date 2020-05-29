<?php
namespace Forum\model;
//chargement de la class Manager
require("vendor/autoload.php");
use Forum\model\Manager;

class editprofilManager extends Manager
{
	public function reqUser($userId)
	{
		$db = $this->dbconnect();
		$requser = $db->prepare("SELECT * FROM users WHERE user_id = ?");
   		$requser->execute(array($userId));
   		return $requser;
	}

   public function reqMail($newmail, $userId)
    {
    	$db = $this->dbconnect();
      $insertmail = $db->prepare("UPDATE users SET mail = ? WHERE user_id = ?");
      $insertmail->execute(array($newmail, $userId));
      return $insertmail;
    }

    public function reqPseudo($newpseudo, $userId)
    {
    	$db = $this->dbconnect();
      $insertpseudo = $db->prepare("UPDATE users SET pseudo = ? WHERE user_id = ?");
      $insertpseudo->execute(array($newpseudo, $userId));
      return $insertpseudo;
    }

    public function reqMdp($mdp1, $userId)
    {
    	$db = $this->dbconnect();
    	$insertmdp = $db->prepare("UPDATE users SET pass = ? WHERE user_id = ?");
      $insertmdp->execute(array($mdp1, $userId));
      return $insertmdp;
        
    }

    public function reqAvatar($avatar, $userId)
    {
      $db = $this->dbconnect();
      $updateavatar = $db->prepare('UPDATE users SET avatar = ? WHERE user_id = ?');
      $updateavatar->execute(array($avatar, $userId));
      return $updateavatar;
                          
    }

}