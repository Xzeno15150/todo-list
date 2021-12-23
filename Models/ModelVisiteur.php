<?php 

/**
 * Classe ModelVisiteur
 *
 * Gère les données liées au Visiteur
 */
class ModelVisiteur
{
    // Nombre de Liste par page
    public static int $NB_PAR_PAGE = 10;

    /**
     * Retourne le nombre de pages publiques
     * @return float Nombre de pages
     */
	public static function getNbPagesPublics()
    {
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lGateway = new ListeGateway($con);
        return $lGateway->getNbPagesPublics(self::$NB_PAR_PAGE);
	}

    /**
     * Retourne les Listes publiques de la page donnée
     * @param int $page Numéro de page des Listes publiques
     * @return array Toutes les Listes publiques de la page
     */
	public static function getListsPubliques(int $page)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		return $lg->getPublicListsByPage($page, self::$NB_PAR_PAGE);
	}

    /**
     * Ajouter une Liste Publique
     * @param string $nom Nom de la Liste
     */
	public static function addListePub(string $nom)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
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
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$tg = new TacheGateway($con);
		$tg->createTache($titre, $desc, $idListe);
	}

    /**
     * Supprimer une Liste
     * @param int $idListe ID de la Liste à supprimer
     */
	public static function removeListe(int $idListe)
	{
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
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
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
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
		$con = new Connection(Config::$dsn, Config::$usr, Config::$pass);
		$lg = new ListeGateway($con);
		$lg->modifyListe($idListe, $nom);
	}

}