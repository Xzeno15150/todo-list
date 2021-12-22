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
     * @param int|null $idListe ID de la Tache (NULL pour laisser la base l'autoincrementer)
     * @return bool Retourne 'true' si ça à fonctionner, 'false' sinon
     */
	public function createTache(string $titre, string $desc, ?int $idListe)
	{
		$query = "INSERT INTO Tache(title, descT, dateT, idListe) VALUES(:title, :descT, CURDATE()), :idListe)";
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
     */
	public function checkTacheById(int $id)
	{
		$query = "UPDATE Tache SET checked = 1-checked WHERE id = :id";
		$this->con->executeQuery($query,array(':id' => array($id,PDO::PARAM_INT)));
	}
}
