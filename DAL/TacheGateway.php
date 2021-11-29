<?php

require 'DAL/Metier/Tache.php';
require 'DAL/Connection.php';

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

	public function createTache($tache, $idListe)
	{
		$query = "INSERT INTO Tache(title, descT, dateT, idListe) VALUES(:title, :descT, STR_TO_DATE(:dateT, '%d/%m/%Y'), :idListe)";
		return $con->executeQuery($query, array(
			':title' => array($tache->getTitle(), PDO::PARAM_STR),
			':descT' => array($tache->getDesc(), PDO::PARAM_STR),
			':dateT' => array($tache->getDate(), PDO::PARAM_STR),
			':idListe' => array($idListe, PDO::PARAM_INT)
		));
	}

	public function deleteTacheById($id)
	{
		$query = "DELETE FROM Tache WHERE id = :id"
		return $con->executeQuery($query, array(
			':id' => array($id, PDO::PARAM_INT)
		));
	}
}
