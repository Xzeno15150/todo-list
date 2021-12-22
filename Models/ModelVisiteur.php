<?php 

/**
 * 
 */
class ModelVisiteur
{
	public static function getNbPagesPublics() 
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lGateway = new ListeGateway($con);
		return $lGateway->getNbPagesPublics(10);
	}

	public static function getNbPagesPrivees($user)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lGateway = new ListeGateway($con);	
		return $lGateway->getNbPagesPrivees(10, $user->getId());
	}
	
	public static function getListsPubliques($page)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		return $lg->getListsByPage($page, 10);
	}

	public static function getListsPrivee($page, $user)
	{	
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		return $lg->getListsByUserByPage($page, 10, $user->getId());
	}

	public static function addListePub($liste) 
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		$lg->createListePublic($liste);
	}

	public static function addTacheToListe($tache, $idliste)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$tg = new TacheGateway($con);
		$tg->creerTache($tache,$idListe);
	}

	public static function removeListe($idListe) 
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		if ($lg->getListById($idListe) != NULL) {
			$lg->deleteListeById($idListe);
		}
		
	}

	public function checkListe($idListe)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		$lg->checkListById($idListe);
	}

	public function modifyListe($idListe, $nom)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		$lg->modifyListe($idListe, $nom);
	}

}