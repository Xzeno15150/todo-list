<?php

/**
 * 
 */
class ModelUtilisateur
{

	public static function creerListePrivee($nom, $user) {
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);

		$lg->createListePrivee($nom, $user);
	}

	public static function creerUtil($pseudo,$mdp)
	{
		$pseudo = Nettoyer::NettoyerString($pseudo);
		$mdp = Nettoyer::NettoyerString($mdp);
		$gw = new UtilisateurGateway(new Connection(Config::$dsn, Config::$usr, Config::$pass));
		$hash =	password_hash($mdp, PASSWORD_DEFAULT);
		$gw->createUtilisateur($pseudo,$mdp);
	}

	public static function connection($pseudo,$mdp)
	{
		$pseudo = Nettoyer::NettoyerString($pseudo);
		$mdp = Nettoyer::NettoyerString($mdp);
		$gw = new UtilisateurGateway(new Connection(Config::$dsn, Config::$usr, Config::$pass));
		$hash = $gw->getMdpByPseudo($pseudo);

		if(!isset($hash)) {
			throw new Exception('Mauvais pseudo');
		}
		//$existe = password_verify($mdp,$hash);

		if($mdp == $hash){
			$_SESSION['role'] = 'user';
			$_SESSION['pseudo'] = $pseudo;
		}
		else {
			throw new Exception('Mauvais mot de passe');
		}
	}

	public static function deconnection()
	{
		session_unset();
		session_destroy();
		$_SESSION = array();	
	}
	
	public static function isUser()
	{
		if (isset($_SESSION['pseudo']) && isset($_SESSION['role']))
		{
			$pseudo = Nettoyer::NettoyerString($_SESSION['pseudo']);
			$role = Nettoyer::NettoyerString($_SESSION['role']);
			if($role=='user')
			{
				$gw = new UtilisateurGateway(new Connection(Config::$dsn, Config::$usr, Config::$pass));
				return $gw->getUserByPseudo($pseudo);
			}
		}
		return null;
	}	
}
?>