<?php 

/**
 * Classe ModelVisiteur
 *
 * Gère les données liées au Visiteur
 */
class ModelVisiteur
{
    // Nombre de Liste par page
    private static $NB_PAR_PAGE_LISTE = 10;
    private static $NB_PAR_PAGE_TACHE = 5;

    /**
     * Retourne le nombre de pages publiques
     * @return float Nombre de pages
     */
	public static function getNbPagesPublics()
    {
    	global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$lGateway = new ListeGateway($con);
        return $lGateway->getNbPagesPublics(self::$NB_PAR_PAGE_LISTE);
	}

    /**
     * Retourne les Listes publiques de la page donnée
     * @param int $page Numéro de page des Listes publiques
     * @return array Toutes les Listes publiques de la page
     */
	public static function getListsPubliques(int $page)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$lg = new ListeGateway($con);
		return $lg->getPublicListsByPage($page, self::$NB_PAR_PAGE_LISTE);
	}

    /**
     * Ajouter une Liste Publique
     * @param string $nom Nom de la Liste
     */
	public static function addListePub(string $nom)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$lg = new ListeGateway($con);
		$lg->createListePublic($nom);
	}

    /**
     * Ajouter une Tache à une Liste
     * @param string $titre Nom de la Tâche
     * @param string $desc Description de la Tâche
     * @param int $idListe ID de la Liste
     */
	public static function addTacheToListe(string $titre, string $desc, int $idListe)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$tg = new TacheGateway($con);
		$tg->createTache($titre, $desc, $idListe);
	}

    /**
     * Supprimer une Liste
     * @param int $idListe ID de la Liste à supprimer
     */
	public static function removeListe(int $idListe)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$lg = new ListeGateway($con);
		if ($lg->getListById($idListe) != NULL) {
			$lg->deleteListeById($idListe);
		}
		
	}

    /**
     * Inverse l'état (terminée ou non) de la Liste
     * @param int $idListe ID de la Liste à modifier
     */
	public static function checkListe(int $idListe)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$lg = new ListeGateway($con);
		$lg->checkListById($idListe);
	}

    /**
     * Modifier le nom d'une Liste
     * @param int $idListe ID de la Liste à modifier
     * @param string $nom Nouveau nom de la Liste
     */
	public static function modifyListe(int $idListe, string $nom)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$lg = new ListeGateway($con);
		$lg->modifyListe($idListe, $nom);
	}

	/**
	 * Retourne la Liste demandée
	 * @param int $idListe ID de la Liste
	 * @return Liste Instance de la Liste
	 */ 
	public static function getListeByID(int $idListe)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$lg = new ListeGateway($con);
		return $lg->getListById($idListe);
	}

	/**
	 * Retourne le nombre de page de Taches d'une Liste donnée
	 * @param int $idListe ID de la Liste
	 * @return int Retourne le nombre de page
	 */
	public static function getNbPagesTaches(int $idListe)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$tg = new TacheGateway($con);
		return $tg->getNbPages(self::$NB_PAR_PAGE_TACHE, $idListe);
	}

	/**
	 * Retourne les Tâches d'une Liste
	 * @param int $page Numéro de la page
	 * @param int $idListe ID de la Liste
	 * @return array Retourne les Tâches de la Liste
	 */
	public static function getTaches(int $page, int $idListe)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$tg = new TacheGateway($con);
		return $tg->getTachesByPage($page, self::$NB_PAR_PAGE_TACHE, $idListe);
	}

	/**
	 * Change l'état de la Tâche
	 * @param int $idTache ID de la Tâche 
	 */
	public static function checkTache(int $idTache)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$tg = new TacheGateway($con);
		$tg->checkTacheById($idTache);
	}
}