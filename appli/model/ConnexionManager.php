<?php
namespace Forum\Model;
//chargement de la class Manager
require("vendor/autoload.php");
use Forum\model\Manager;

class ConnexionManager extends Manager
{
	public function connexion($pseudoconnect)
	{
		$db = $this->dbconnect();
      	$requser = $db->prepare("SELECT * FROM users WHERE pseudo = ?");
      	$requser->execute(array($pseudoconnect));
      	return $requser;
	}
   
}