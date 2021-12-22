<?php


class ListeGateway
{
	private $con;

	public function __construct($con)
	{
		$this->con=$con;
	}

	public function createListePublic($nom)
	{
		$query = "INSERT INTO Liste(nom, dateL) VALUES(:nom, CURDATE())";
		return $this->con->executeQuery($query,array(
			':nom' => array($nom, PDO::PARAM_STR)));
	}

	public function createListePrivee($nom, $user)
	{
		$query = 'INSERT INTO Liste(nom, idUtil, dateL) VALUES (:nom, :iduser, CURDATE())';
		return $this->con->executeQuery($query, array(
			':nom' => array($nom, PDO::PARAM_STR),
			':iduser' => array($user->getId(), PDO::PARAM_INT)));
	}

	public function deleteListeById($id)
	{
		$query = "DELETE FROM Liste WHERE id=:id";
		return $this->con->executeQuery($query,array(
			':id' => array($id, PDO::PARAM_INT)));
	}


	public function getListsByUserByPage($page, $nbparpages, $iduser) {
		$premierepage = ($page-1)*$nbparpages;
		if ($iduser != NULL) {
			$query = "SELECT * FROM Liste  WHERE idUtil = :idutil 
					LIMIT :premierepage, :nbparpages";
			$this->con->executeQuery($query, array(
				':idutil' => array($iduser, PDO::PARAM_INT),
				':premierepage' => array($premierepage, PDO::PARAM_INT),
				':nbparpages' => array($nbparpages, PDO::PARAM_INT)));
		} else {
			$query = "SELECT * FROM Liste  WHERE idUtil IS NULL 
			LIMIT :premierepage, :nbparpages";
			$this->con->executeQuery($query, array(
				':premierepage' => array($premierepage, PDO::PARAM_INT),
				':nbparpages' => array($nbparpages, PDO::PARAM_INT)));
		}
		
		$res = $this->con->getResults();
		$tab = [];
		foreach ($res as $row) {
			$tab[] = new Liste($row['nom'], $row['id'], $row['checked'], $row['idUtil']);
		}
		return ($tab);
	}

	public function getListsByPage($page, $nbparpages)
	{
		return $this->getListsByUserByPage($page, $nbparpages, NULL);
	}


	public function getNbPagesPrivees($nbparpages, $user)
	{
		if ($user != NULL) {
			$query = "SELECT COUNT(*) FROM Liste where idUtil = :iduser";

			$this->con->executeQuery($query, array(
				':iduser' => array($user, PDO::PARAM_INT)));
		}
		else {
			$query = "SELECT COUNT(*) FROM Liste where idUtil IS NULL";
			$this->con->executeQuery($query);
		}
		

		$res = $this->con->getResults();
		return ceil($res[0][0]/$nbparpages);

	}

	public function getNbPagesPublics($nbparpages)
	{
		return $this->getNbPagesPrivees($nbparpages, NULL);
	}

	public function getListById($id)
	{
		$query = "SELECT * FROM Liste WHERE id = :id";
		$this->con->executeQuery($query, array(
			':id' => array($id, PDO::PARAM_INT)));

		$res = $this->con->getResults();
		if ($res[0] == NULL) {
			return NULL;
		}
		$row = $res[0];
		return new Liste($row['nom'], $row['id'], $row['checked'], $row['idUtil']);
	}

	public function checkListById($id)
	{
		$query = "UPDATE Liste SET checked = 1-checked WHERE id = :id";
		$this->con->executeQuery($query,
			array(':id' => array($id, PDO::PARAM_INT)));
	}

	public function modifyListe($id, $nom)
	{
		$query = "UPDATE Liste SET nom = :nom WHERE id = :id";
		$this->con->executeQuery($query, array(
			":id" => array($id, PDO::PARAM_INT),
			":nom" => array($nom, PDO::PARAM_STR)
		));
	}
}
