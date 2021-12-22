<?php

/**
 * Classe Gateway de Liste
 */
class ListeGateway
{
	private $con;

    /**
     * Constructeur de ListeGateway
     * @param Connection $con Instance de Connection à la base
     */
	public function __construct(Connection $con)
	{
		$this->con=$con;
	}

    /**
     * Créer une nouvelle Liste publique en base
     * @param string $nom Nom de la Liste
     * @return bool Retourne 'true' si ça à fonctionner, 'false' sinon
     */
	public function createListePublic(string $nom)
	{
		$query = "INSERT INTO Liste(nom, dateL) VALUES(:nom, CURDATE())";
		return $this->con->executeQuery($query,array(
			':nom' => array($nom, PDO::PARAM_STR)));
	}

    /**
     * Créer une nouvelle Liste privée en base
     * @param string $nom Nom de la Liste
     * @param Utilisateur $user Utilisateur propriétaire de cette Liste
     * @return bool Retourne 'true' si ça à fonctionner, 'false' sinon
     */
	public function createListePrivee(string $nom, Utilisateur $user)
	{
		$query = 'INSERT INTO Liste(nom, idUtil, dateL) VALUES (:nom, :iduser, CURDATE())';
		return $this->con->executeQuery($query, array(
			':nom' => array($nom, PDO::PARAM_STR),
			':iduser' => array($user->getId(), PDO::PARAM_INT)));
	}

    /**
     * Supprime une Liste en base
     * @param int $id ID de la liste à supprimer
     * @return bool Retourne 'true' si ça à fonctionner, 'false' sinon
     */
	public function deleteListeById(int $id)
	{
		$query = "DELETE FROM Liste WHERE id=:id";
		return $this->con->executeQuery($query,array(
			':id' => array($id, PDO::PARAM_INT)));
	}

    /**
     * Retourne toutes les Liste privée d'une page donnée
     * @param int $page Numéro de la page
     * @param int $nbparpages Nombre de Liste sur la page
     * @param int|null $iduser ID du propriétaire de la liste (NULL si publique)
     * @return array
     */
	public function getListsByUserByPage(int $page, int $nbparpages, ?int $iduser) {
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

    /**
     * Rertourne les Liste publiques d'une page donnée
     * @param int $page Numéro de la page
     * @param int $nbparpages Nombre de Liste sur la page
     * @return array
     */
	public function getListsByPage(int $page, int $nbparpages)
	{
		return $this->getListsByUserByPage($page, $nbparpages, NULL);
	}

    /**
     * Retourne le nombre de page de Liste privée d'un utilisateur
     * @param int $nbparpages Nombre de Liste par page
     * @param Utilisateur|null $user Utilisateur propriétaire des List (NULL si publiques)
     * @return false|float Retourne false si le résultat n'est pas trouvé, sinon retourne le nombre de pages
     */
	public function getNbPagesPrivees(int $nbparpages, ?Utilisateur $user)
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

    /**
     * Retourne le nombre de pages de Liste publiques
     * @param int $nbparpages Nombre de Liste par page
     * @return false|float Retourne false si le résultat n'est pas trouvé, sinon retourne le nombre de pages
     */
	public function getNbPagesPublics(int $nbparpages)
	{
		return $this->getNbPagesPrivees($nbparpages, NULL);
	}

	public function getListById(int $id)
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

    /**
     * Modifie l'état (terminée ou non) d'une Liste
     * @param int $id ID de la Liste à modifier
     */
	public function checkListById(int $id)
	{
		$query = "UPDATE Liste SET checked = 1-checked WHERE id = :id";
		$this->con->executeQuery($query,
			array(':id' => array($id, PDO::PARAM_INT)));
	}

    /**
     * Modifie le nom d'une liste
     * @param int $id ID de la Liste à modifier
     * @param string $nom Nouveau nom de la Liste
     */
	public function modifyListe(int $id, string $nom)
	{
		$query = "UPDATE Liste SET nom = :nom WHERE id = :id";
		$this->con->executeQuery($query, array(
			":id" => array($id, PDO::PARAM_INT),
			":nom" => array($nom, PDO::PARAM_STR)
		));
	}
}
