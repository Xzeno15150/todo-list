<?php 

/*
 * Classe Gateway de l'Utilisateur
 */
class UtilisateurGateway
{
	private $con;

    /**
     * Constructeur de UtilisateurGateway
     * @param Connection $con Instance de la Connection à la base
     */
	public function __construct(Connection $con)
	{
		$this->con = $con;
	}

    /**
     * Retourne un Utilisateur à partir de son ID
     * @param int $id ID de l'Utilisateur à rechercher
     * @return Utilisateur|void Retourne void si l'utilsateur n'est pas trouvé
     */
	public function getUtilisateurById(int $id)
	{
		$query = 'SELECT * FROM Utilisateur WHERE id = :id';
		$this->con->executeQuery($query, array(
			":id" => array($id, PDO::PARAM_INT)));

		$res = $this->con->getResults();
		foreach ($res as $row) {
			return new Utilisateur($row['id'], $row['pseudo']);
		}
	}

    /**
     * Retourne un Utilisateur à partir d'un pseudo
     * @param string $pseudo Pseudo de l'Utilsateur à rechercher
     * @return Utilisateur|void Retourne void si l'utilisateur n'est pas trouvé
     */
	public function getUserByPseudo(string $pseudo)
	{
		$query = 'SELECT * FROM Utilisateur WHERE pseudo = :pseudo';
		$this->con->executeQuery($query, array(
			":pseudo" => array($pseudo, PDO::PARAM_STR)));

		$res = $this->con->getResults();
		foreach ($res as $row) {
			return new Utilisateur($row['id'], $row['pseudo']);
		}
	}

    /**
     * Retourne le hash de L'utilsateur gardé en base
     * @param string $pseudo Pseudo de l'Utilisateur à rechercher
     * @return mixed|void
     */
	public function getMdpByPseudo (string $pseudo)
	{
		$query = 'SELECT mdp FROM Utilisateur WHERE pseudo = :pseudo';
		$this->con->executeQuery($query, array(
			":pseudo" => array($pseudo, PDO::PARAM_STR)));

		$res = $this->con->getResults();
		foreach ($res as $row) {
			return $row['mdp'];
		}
	}

    /**
     * Création d'un Utilisateur en base
     * @param string $pseudo Pseudo de l'Utilisateur
     * @param string $mdp Hash du mot de passe de l'utilisateur
     * @return bool Retourne 'true' si ça à fonctionner, 'false' sinon
     */
	public function createUtilisateur(string $pseudo, string $mdp) 
	{
		$query = 'INSERT INTO Utilisateur(pseudo, mdp) VALUES (:pseudo, :mdp)';
		return $this->con->executeQuery($query, array(
			':pseudo' => array($pseudo, PDO::PARAM_STR),
			':mdp' => array($mdp, PDO::PARAM_STR)));
	}
}