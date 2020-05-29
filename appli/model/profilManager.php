<?php
namespace Forum\model;
//chargement de la class Manager
require("vendor/autoload.php");
use Forum\model\Manager;

class profilManager extends Manager
{
	public function reqUser($userId)
	{
		$db = $this->dbconnect();
		$requser = $db->prepare("SELECT * FROM users WHERE id = ?");
   		$requser->execute(array($userId));
   		return $requser;
	}

   
}