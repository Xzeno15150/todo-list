<?php

/**
 * Classe ModelUtilisateur
 *
 * Gère les données liées à l'Utilisateur
 */
class ModelUtilisateur
{
	private static $NB_PAR_PAGE = 10;

    /**
     * Création d'une Liste Privée
     * @param string $nom Nom de la nouvelle Liste
     * @param Utilisateur $user Utilisateur propriétaire de la Liste
     */
	public static function creerListePrivee(string $nom, Utilisateur $user) 
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		$lg = new ListeGateway($con);

		$lg->createListePrivee($nom, $user);
	}

    /**
     * Retourne les Listes de l'Utilisateur de la page donnée
     * @param int $page Numéro de page des Listes privées
     * @param Utilisateur $user Utilisateur propriétaire
     * @return array Toutes les Listes privées de la page
     */
    public static function getListsPrivee(int $page, Utilisateur $user)
    {
        global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
        $lg = new ListeGateway($con);
        return $lg->getListsByPage($page, self::$NB_PAR_PAGE, $user->getId());
    }

    /**
     * Retourne le nombre de pages privées de l'Utilisateur donné
     * @param Utilisateur $user Utilisateur connecté
     * @return float Nombre de pages
     */
    public static function getNbPagesPrivees(Utilisateur $user)
    {
        global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
        $lGateway = new ListeGateway($con);
        return $lGateway->getNbPages(self::$NB_PAR_PAGE, $user->getId());
    }

    /**
     * Création d'un Utilisateur, lors de l'inscription.
     *
     * Hash le mot de passe donnée avant la sauvegarde.
     * @param string $pseudo Pseudo de l'Utilisateur
     * @param string $mdp Mot de passe de l'Utilisateur
     * @throws Exception Lance une exception si le pseudo est déjà pris
     */
	public static function creerUtil(string $pseudo, string $mdp)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);

		$pseudo = Nettoyer::NettoyerString($pseudo);
		$mdp = Nettoyer::NettoyerString($mdp);
		$gw = new UtilisateurGateway($con);

        // Hashage du mot de passe avant sauvegarde en base
		$hash =	password_hash($mdp, PASSWORD_DEFAULT);

		if ($gw->getUserByPseudo($pseudo) != NULL) {
			throw new Exception("Ce pseudo existe déjà", 1);
		}
		$gw->createUtilisateur($pseudo,$hash);
	}

    /**
     * Connection à un compte Utilisateur
     *
     * Vérifie si le pseudo existe en base.
     * Puis vérifie si le mot de passe en clair correspond au hash en base
     * @param string $pseudo Pseudo de l'Utilisateur
     * @param string $mdp Mot de passe de l'Utilisateur
     * @throws Exception Lance une exception si le mot de passe ou le pseudo est incorrect
     */
	public static function connection(string $pseudo, string $mdp)
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);

		$pseudo = Nettoyer::NettoyerString($pseudo);
		$mdp = Nettoyer::NettoyerString($mdp);
		$gw = new UtilisateurGateway($con);

		$hash = $gw->getMdpByPseudo($pseudo);

		if(!isset($hash)) {
			throw new Exception('Mauvais pseudo');
		}
		$existe = password_verify($mdp,$hash);

        // Si le compte existe, on met le rôle et le pseudo en SESSION
		if($existe){
			$_SESSION['role'] = 'user';
			$_SESSION['pseudo'] = $pseudo;
		}
		else {
			throw new Exception('Mauvais mot de passe');
		}
	}

    /**
     * Déconnection d'un compte Utilisateur
     *
     * Vide toutes les variables de SESSION, puis détruit la SESSION
     */
	public static function deconnection()
	{
		session_unset();
		session_destroy();
		$_SESSION = array();	
	}

    /**
     * Vérifie si un Utilisateur est connecté grâce aux variables de SESSION
     * @return Utilisateur|void|null Renvoi l'instance de l'Utilisateur s'il est connecté, void ou null sinon
     */
	public static function isUser()
	{
		global $dsn;
    	global $pass;
    	global $usr;

		$con = new Connection($dsn, $usr, $pass);
		
		if (isset($_SESSION['pseudo']) && isset($_SESSION['role']))
		{
			$pseudo = Nettoyer::NettoyerString($_SESSION['pseudo']);
			$role = Nettoyer::NettoyerString($_SESSION['role']);
			if($role=='user')
			{
				$gw = new UtilisateurGateway($con);
				return $gw->getUserByPseudo($pseudo);
			}
		}
		return null;
	}	
}