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
		return$lGateway->getNbPagesPublics(10);
	}

	public static function getNbPagesPrivees($user)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lGateway = new ListeGateway($con);	
		return $lGateway->getNbPagesPrivees(10, $user);
	}
	
	public static function getListsPubliques($page)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		return $lg->getListsByPage($page,self::getNbPagesPublics());
	}

	public static function getListsPrivee($page, $user)
	{	
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		return $lg->getListsByUserByPage($page, self::getNbPagesPrivees($user), $user);
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

	public static function removeListe($idliste) 
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		$lg->deleteListeById($idListe);
	}

}