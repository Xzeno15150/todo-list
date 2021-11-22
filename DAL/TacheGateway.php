<?php

require 'Tache.php';
require '../Connection.php';

/**
 * Gateway pour la class Tache
 */
class TacheGateway
{
	private $con;

	public function __construct($con)
	{
		$this->con = $con;
	}

	public function createTache($tache)
	{
		$query = "INSERT INTO Tache(title, descT, dateT) VALUES(:title, :descT, STR_TO_DATE(:dateT, '%d/%m/%Y'))";
		return $con->executeQuery($query, array(
			':title' => array($tache->getTitle(), PDO::PARAM_STR),
			':descT' => array($tache->getDesc(), PDO::PARAM_STR),
			':dateT' => array($tache->getDate(), PDO::PARAM_STR)
		));
	}

	public function deleteTacheById($id)
	{
		$query = "DELETE "
	}
}