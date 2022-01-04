<?php


/**
 * Classe Gateway des Tâches
 */
class TacheGateway
{
	private $con;

    /**
     * Constructeur de TacheGateway
     * @param Connection $con Instance de Connection à la base
     */
	public function __construct(Connection $con)
	{
		$this->con = $con;
	}

    /**
     * Création d'une Tâche en base
     * @param string $titre Titre de la Tâche
     * @param string $desc Description de la Tâche
     * @param int $idListe ID de la Liste propriétaire de la Tache 
     * @return bool Retourne 'true' si ça à fonctionner, 'false' sinon
     */
	public function createTache(string $titre, string $desc, int $idListe)
	{
		$query = "INSERT INTO Tache(title, descT, dateT, idListe) VALUES(:title, :descT, CURDATE(), :idListe)";
		return $this->con->executeQuery($query, array(
			':title' => array($titre, PDO::PARAM_STR),
			':descT' => array($desc, PDO::PARAM_STR),
			':idListe' => array($idListe, PDO::PARAM_INT)
		));
	}

    /**
     * Supprimer une Tâche en base
     * @param int $id ID de la Tâche à supprimer
     * @return bool Retourne 'true' si ça à fonctionner, 'false' sinon
     */
	public function deleteTacheById(int $id)
	{
		$query = "DELETE FROM Tache WHERE id = :id";
		return $this->con->executeQuery($query, array(
			':id' => array($id, PDO::PARAM_INT)
		));

	}

    /**
     * Modifier l'état (terminée ou non) de la Tâche en base
     * @param int $id ID de la Tâche à modifier
     * @return bool Retourne 'true' si ça à fonctionner, 'false' sinon
     */
	public function checkTacheById(int $id)
	{
		$query = "UPDATE Tache SET checked = 1-checked WHERE id = :id";
		return $this->con->executeQuery($query,array(':id' => array($id,PDO::PARAM_INT)));
	}


	/**
	 * Retourne les Tâche d'une Liste donnée pour une page donnée
	 * @param int $page Numéro de la page 
	 * @param int $nbparpage Nombre de Tâche par page
	 * @param int $idListe ID de la Liste propriétaire
	 * @return array Retourne toutes les Tache d'une Liste
	 */ 
	public function getTachesByPage(int $page, int $nbparpage, int $idListe)
	{
		$premierepage = ($page-1)*$nbparpage;
		$query = "SELECT * FROM Tache WHERE idListe = :idListe
				LIMIT :premierepage, :nbparpage";

		$this->con->executeQuery($query, array(
			":idListe" => array($idListe, PDO::PARAM_INT),
			":premierepage" => array($premierepage, PDO::PARAM_INT),
			":nbparpage" => array($nbparpage, PDO::PARAM_INT)));

		$res = $this->con->getResults();
		$tab = [];
		foreach ($res as $row) {
			$tab[] = new Tache($row['title'], $row['descT'], $row['id'], $row['checked']);
		}
		return $tab;
	}

	/**
	 * Retourne le nombre de pages de Tache pour une Liste donnée
	 * @param int $nbparpage Nombre de Tache par page
	 * @param int $idListe ID de la Liste
	 * @return int Retourne le nombre de page
	 */
	public function getNbPages(int $nbparpage, int $idListe)
	{
		$query = "SELECT COUNT(*) FROM Tache WHERE idListe = :idListe";
		$this->con->executeQuery($query, array(
			":idListe" => array($idListe, PDO::PARAM_INT)));

		$res = $this->con->getResults();
		$ret = ceil($res[0][0]/$nbparpage);

		return ($ret != null) ? $ret : 0; 
	}

	/**
	 * Modifie le nom et la description de la Tâche en base
	 * @param int $id ID de la Tâche à modifier
	 * @param string $title Nouveau titre de la Tâche
	 * @param string $desc Nouvelle description 
	 * @return bool Retourne 'true' si ça à fonctionner, 'false' sinon
	 */
	public function modifyTache(int $id, string $title, string $desc)
	{	
		$query = "UPDATE Tache SET title = :title, descT = :descT WHERE id = :id";
		return $this->con->executeQuery($query, array(
			":title" => array($title, PDO::PARAM_STR),
			":descT" => array($desc, PDO::PARAM_STR),
			":id" => array($id, PDO::PARAM_INT)));
	}
}
