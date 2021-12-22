<?php


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
		$query = "INSERT INTO Tache(title, descT, dateT, idListe) VALUES(:title, :descT, CURDATE()), :idListe)";
		return $this->con->executeQuery($query, array(
			':title' => array($tache->getTitle(), PDO::PARAM_STR),
			':descT' => array($tache->getDesc(), PDO::PARAM_STR),
			':idListe' => array($idListe, PDO::PARAM_INT)
		));
	}

	public function deleteTacheById($id)
	{
		$query = "DELETE FROM Tache WHERE id = :id"
		return $this->con->executeQuery($query, array(
			':id' => array($id, PDO::PARAM_INT)
		));

	}
	public function checkTacheById($id)
	{
		$query = "UPDATE Tache SET checked = 1-checked WHERE id = :id";
		$this->con->executeQuery($query,array(':id' => array($id,PDO::PARAM_INT)));
	}
}
