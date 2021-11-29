<?php

require 'DAL/Metier/Liste.php';
/**
 * 
 */
class ListeGateway
{
	private $con;

	public function __construct($con)
	{
		$this->con=$con;
	}

	public function createListe($liste)
	{
		$query = "INSERT INTO Liste(nom) VALUES(:nom)";
		return $this->con->executeQuery($query,array(
			':nom' => array($liste->getNom(), PDO::PARAM_STR)));
	}

	public function deleteListeById($id)
	{
		$query = "DELETE FROM Liste WHERE id=:id";
		return $this->con->executeQuery($query,array(
			':id' => array($id, PDO::PARAM_INT)));
	}

	public function getListsByPage($page, $nbparpages)
	{
		$premierepage = ($page-1)*$nbparpages;
		$query = "SELECT * FROM Liste LIMIT $premierepage, $nbparpages";
		$this->con->executeQuery($query);

		$res = $this->con->getResults();
		foreach ($res as $row) {
			$tab[] = new Liste($row['id'], $row['nom'], $row['checked']);
		}
		return $tab;
	}
}
