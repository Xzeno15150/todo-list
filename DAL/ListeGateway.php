<?php


class ListeGateway
{
	private $con;

	public function __construct($con)
	{
		$this->con=$con;
	}

	public function createListePublic($liste)
	{
		$query = "INSERT INTO Liste(nom) VALUES(:nom)";
		return $this->con->executeQuery($query,array(
			':nom' => array($liste->getNom(), PDO::PARAM_STR)));
	}

	public function createListePrivee($liste, $user)
	{
		$query = 'INSERT INTO Liste(nom, idUtil) VALUES (:nom, :iduser)';
		return $this->con->executeQuery($query, array(
			':nom' => array($liste->getNom(), PDO::PARAM_STR),
			':iduser' => array($user->getId(), PDO::PARAM_INT)));
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
		$query = "SELECT * FROM Liste  WHERE idUtil IS NULL LIMIT :premierepage, :nbparpages";
		$this->con->executeQuery($query, array(
			':premierepage' => array($premierepage, PDO::PARAM_INT),
			':nbparpages' => array($nbparpages, PDO::PARAM_INT)));

		$res = $this->con->getResults();
		$tab = [];
		foreach ($res as $row) {
			$tab[] = new Liste($row['nom'], $row['id'], $row['checked'], $row['idUtil']);
		}
		return $tab;
	}

	public function getListsByUserByPage($page, $nbparpages, $user) {
		$premierepage = ($page-1)*$nbparpages;
		$query = "SELECT * FROM Liste  WHERE idUtil = :idutil LIMIT :premierepage, :nbparpages";
		$this->con->executeQuery($query, array(
			':idutil' => array($user->getId(), PDO::PARAM_INT),
			':premierepage' => array($premierepage, PDO::PARAM_INT),
			':nbparpages' => array($nbparpages, PDO::PARAM_INT)));

		$res = $this->con->getResults();
		$tab = [];
		foreach ($res as $row) {
			$tab[] = new Liste($row['nom'], $row['id'], $row['checked'], $row['idUtil']);
		}
		return ($tab);
	}

	public function getNbPagesPublics($nbparpages)
	{
		$query = "SELECT COUNT(*) FROM Liste where idUtil IS NULL";

		$this->con->executeQuery($query);

		$res = $this->con->getResults();
		
		return ceil($res[0][0]/$nbparpages);
	}

	public function getNbPagesPrivees($nbparpages, $user)
	{
		$query = "SELECT COUNT(*) FROM Liste where idUtil = :iduser";

		$this->con->executeQuery($query, array(
			':iduser' => array($user->getId(), PDO::PARAM_INT)));

		$res = $this->con->getResults();
		return ceil($res[0][0]/$nbparpages);

	}

	public function getListById($id)
	{
		$query = "SELECT * FROM Liste WHERE id = :id";
		$this->con->executeQuery($query, array(
			':id' => array($id, PDO::PARAM_INT)));

		$res = $this->con->getResults();
		$row = $res[0];
		return new Liste($row['nom'], $row['id'], $row['checked'], $row['idUtil']);
	}

	public function checkListById($id)
	{
		$query = "UPDATE Liste SET checked = 1-checked WHERE id = :id";
		$this->con->executeQuery($query,array(':id' => array($id,PDO::PARAM_INT)));
	}
}
