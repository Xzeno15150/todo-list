<?php

/**
 * 
 */
class ModelUtilisateur
{

	public function creerUtil($pseudo,$mdp)
	{
		$pseudo = Nettoyage::NettoyerString($pseudo);
		$mdp = Nettoyage::NettoyerString($mdp);
		$gw = new UtilisateurGateway(new Connection($dsn,$username,$password));
		$hash =	password_hash($mdp, PASSWORD_DEFAULT);
		$gw->createUtilisateur($pseudo,$mdp);
	}

	public function connection($pseudo,$mdp)
	{
		$pseudo = Nettoyage::NettoyerString($pseudo);
		$mdp = Nettoyage::NettoyerString($mdp);
		$gw = new UtilisateurGateway(new Connection($dsn,$username,$password));
		$hash = $gw->getMdpByPseudo($pseudo);

		if(!isset($hash)) {
			throw new Exception('Mauvais pseudo');
		}
		$existe = password_verify($mdp,$hash);

		if($existe){
			$_SESSION['role'] = 'user';
			$_SESSION['pseudo'] = 'pseudo';
		}
		else {
			throw new Exception('Mauvais mot de passe');
		}
	}

	public function deconnection()
	{
		session_unset();
		session_destroy();
		$_SESSION = array();	
	}
	
	public function isUser()
	{
		if (isset($_SESSION['pseudo']) && isset($_SESSION['role']))
		{
			$pseudo = Nettoyer::NettoyerString($_SESSION['pseudo']);
			$role = Nettoyer::NettoyerString($_SESSION['role']);
			if($role=='user')
			{
				$gw = new UtilisateurGateway(new Connection($dsn,$username,$password));
				return $gw->getUserByPseudo($pseudo);
			}
			return null;
		}
		return null;
	}	
}
?>