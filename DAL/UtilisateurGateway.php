<?php 

require 'DAL/Metier/Connection.php';

/**
 * 
 */
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
		return $this->con->executeQuery($query, array(
			":id" => array($id, PDO::PARAM_INT)));
	}
}