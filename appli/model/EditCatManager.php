<?php
namespace Forum\model;
//chargement de la class Manager
require("vendor/autoload.php");
use Forum\model\Manager;

class EditCatManager extends Manager

{
	public function edit($title)//Insertion d'une catégorie
	{
		$db = $this->dbconnect();
      	$inser = $db->prepare('INSERT INTO categories (title, creation_date) VALUES (?, NOW())');
      	$inser->execute(array($title));
      	return $inser;
	}
   
}
