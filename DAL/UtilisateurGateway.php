<?php 


class UtilisateurGateway
{
	private $con;
	
	public function __construct(Connection $con)
	{
		$this->con = $con;
	}

	public function getUtilisateurById(int $id)
	{
		$query = 'SELECT * FROM Utilisateur WHERE id = :id';
		$this->con->executeQuery($query, array(
			":id" => array($id, PDO::PARAM_INT)));

		$res = $this->con->getResults();
		$tab = [];
		foreach ($tab as $row) {
			$tab[] = new Utilisateur($row['id'], $row['pseudo'], $row['mdp']);
		}
		return $tab;
	}

	public function createUtilisateur(string $pseudo, string $mdp) 
	{
		$query = 'INSERT INTO Utilisateur(pseudo, mdp) VALUES (:pseudo, :mdp)';
		return $this->con->executeQuery($query, array(
			':pseudo' => array($pseudo, PDO::PARAM_STR),
			':mdp' => array($mdp, PDO::PARAM_STR)));
	}
}