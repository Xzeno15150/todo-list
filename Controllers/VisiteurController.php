<?php

/**
 * Classe VisiteurController
 *
 * Gère les actions du Visiteur
 */
class VisiteurController
{
    /**
     * Constructeur de VisiteurController
     *
     * Appel les méthodes correspondante à l'action demandée
     * @param string $action Action demandée
     * @throws Exception Lance une exception si l'action n'existe pas
     */
	public function __construct(string $action)
	{
        switch ($action) {

            // Actions d'affichages
            case 'afficherListes':
                $this->afficherListes();
                break;
            case 'afficherTaches' :
                $this->afficherTaches();
                break;


            // Actions sur les Liste
            case 'creerListePub':
                $this->creerListePub();
                break;
            case 'supListe':
                $this->supListe();
                break;
            case 'checkListe':
                $this->checkListe();
                break;
            case 'editListe' :
                $this->editListe();
                break;


            // Actions sur les Tâches
            case 'creerTache' :
                $this->creerTache();
                break;
            case 'checkTache':
            	$this->checkTache();
                break;
            case 'editTache' :
            	$this->editTache();
            	break;


            // Actions sur le compte
            case 'connecter':
                $this->connecter();
                break;
            case 'inscription':
                $this->inscription();
                break;


            default:
                throw new Exception("Action inexistante", 1);
        }

	}

    /**
     * Affichages des Listes
     *
     * Affiche les listes publiques et privées si l'utilisateur est connecté.
     * L'affichage se fait par pages, avec un maximum de 10 listes par pages.
     * Le nombre de pages est calculé depuis la base de données.
     * Affiche aussi l'édition de Liste si c'est nécessaire
     */
	public function afficherListes()
	{
		global $rep;
		global $vues;
        // Si pas de page demandée, la page par défaut est la 1
		$pagePublic = 1;
		if (isset($_GET['pagePublic'])) 
		{
			$pagePublic = Nettoyer::NettoyerInt((int) $_GET['pagePublic']);
		}
		
		$nbPagesPublics = ModelVisiteur::getNbPagesPublics();
		$pagePublic = Validation::validationPage($pagePublic,$nbPagesPublics);
		$public_lists = ModelVisiteur::getListsPubliques($pagePublic);

        // Instance de l'utilisateur, null s'il n'est pas connecté
		$user_connected = ModelUtilisateur::isUser();
		if ($user_connected != NULL) 
		{
            // Si pas de page demandée, la page par défaut est la 1
			$pagePrivee = 1;
			if (isset($_GET['pagePrivee'])) {
				$pagePrivee = Nettoyer::NettoyerInt((int) $_GET['pagePrivee']);
			}
			
			$nbpagesprivees = ModelUtilisateur::getNbPagesPrivees($user_connected);
			$pagePrivee = Validation::validationPage($pagePrivee, $nbpagesprivees);
			$private_lists = ModelUtilisateur::getListsPrivee($pagePrivee, $user_connected);
		}
        // En cas de demande d'édition
		if (isset($_GET['idEdit'])) {
			$idEdit = Nettoyer::NettoyerInt((int) $_GET['idEdit']);
		}

        // Appel des vues
		require_once $rep.$vues["header"];
		require_once $rep.$vues["main"];
	}

	/**
 	* Affichage des Tache d'une Liste
 	* 
 	* Affichage de l'édition d'une Tache
 	* @param int $idListe ID de la Liste
 	*/
	public function afficherTaches(int $id = null)
	{
		global $rep;
		global $vues;

		if (!isset($_GET['id'])) {
			if ($id == null) {
				$this->afficherListes();
				return;
			}
			$idListe = $id;
		}
		else{
			$idListe = Nettoyer::NettoyerInt((int) $_GET['id']);
		}
		$liste = ModelVisiteur::getListeByID($idListe);
		$page = 1;
		if (isset($_GET['page'])) {
			$page = Nettoyer::NettoyerInt((int) $_GET['page']);
		}


		$nbpages = ModelVisiteur::getNbPagesTaches($idListe);
		$page = Validation::validationPage($page, $nbpages);
		$lesTaches = ModelVisiteur::getTaches($page, $idListe);

		if (isset($_GET['idEdit'])) {
			$idEdit = Nettoyer::NettoyerInt((int) $_GET['idEdit']);
		}

		require_once $rep.$vues["header"];
		require_once $rep.$vues['liste'];
	}

    /**
     * Création d'une Liste publique
     */
	public function creerListePub()
	{
		if(isset($_POST['nomListePub']))
		{
			$nomListe = Nettoyer::NettoyerString($_POST['nomListePub']);
			ModelVisiteur::addListePub($nomListe);
			$this->afficherListes();
		}
	}

    /**
     * Création d'une Tache
     */
	public function creerTache()
	{
		if (isset($_POST['titleTache']) and isset($_POST['descTache']) and isset($_POST['idListe'])) {

			$idListe = Nettoyer::NettoyerInt((int) $_POST['idListe']);
			$nomTache = Nettoyer::NettoyerString($_POST['titleTache']);
			$descTache = Nettoyer::NettoyerString($_POST['descTache']);

			ModelVisiteur::addTacheToListe($nomTache, $descTache, $idListe);

			$this->afficherTaches($idListe);
		}

	}

    /**
     * Suppression d'une Liste
     */
	public function supListe()
	{
		if (isset($_GET['id'])) 
		{
			$idListe = Nettoyer::NettoyerInt($_GET['id']);
			ModelVisiteur::removeListe($idListe);
			$this->afficherListes();
		}

	}

    /**
     * Se connecter à un compte Utilisateur
     *
     * Si la connection échoue, on rappelle la vue de connection
     */
	public function connecter()
	{
		global $rep;
		global $vues;

		try {
			if (isset($_POST['inputPseudo']) and isset($_POST['inputMDP'])) {
				$pseudo = Nettoyer::NettoyerString($_POST['inputPseudo']);
				$mdp = Nettoyer::NettoyerString($_POST['inputMDP']);

				ModelUtilisateur::connection($pseudo, $mdp);
				header('Location: index.php');
			}
		}
		catch (Exception $e) {
			require_once $rep.$vues["connection"];
			$dVueErreur[] = $e;
			require_once $rep.$vues["erreur"];
		}
		
	}


    /**
     * Changer l'état de la Liste
     *
     * Si la Liste était cochée comme terminée, elle ne l'ai plus, et inversement
     * On réaffiche ensuite la vue des Listes
     */
	public function checkListe()
	{
		if (isset($_GET['id']))  {
			$idListe = Nettoyer::NettoyerInt($_GET['id']);
			ModelVisiteur::checkListe($idListe);
			$this->afficherListes();
		}
	}

	/**
	 * Changer l'état de la Tâche
	 */
	public function checkTache()
	{
		if (isset($_GET['id']) && isset($_GET['idt'])) {
			$id = Nettoyer::NettoyerInt((int) $_GET['idt']);
			ModelVisiteur::checkTache($id);
			$idl = Nettoyer::NettoyerInt((int) $_GET['id']);
			$this->afficherTaches($idl);
		}
	}

    /**
     * Changer le nom d'une Liste
     */
	public function editListe()
	{
		if (isset($_POST['idEdit']) && isset($_POST['editListeNom'])) {
			$idListe = Nettoyer::NettoyerInt((int) $_POST['idEdit']);
			$nomListe = Nettoyer::NettoyerString($_POST['editListeNom']);

			ModelVisiteur::modifyListe($idListe, $nomListe);
			$this->afficherListes();
		}
	}

	/**
	 * Changer le nom et la description de la Tâche
	 */
	public function editTache()
	{
		try{
			if (isset($_POST['idEdit']) 
					&& isset($_POST['editTacheTitle'])
					&& isset($_POST['editTacheDesc'])
					&& isset($_GET['idl'])) 
			{
				$idt = Nettoyer::NettoyerInt((int) $_POST['idEdit']);
				$title = Nettoyer::NettoyerString($_POST['editTacheTitle']);
				$desc = Nettoyer::NettoyerString($_POST['editTacheDesc']);
				$idl = Nettoyer::NettoyerInt((int) $_GET['idl']);
				
				ModelVisiteur::modifyTache($idt, $title, $desc);
				$this->afficherTaches($idl);
			}
			echo "dfugh";
		}
		catch(Exception $e) {
			$dVueErreur[] = $e;
			require_once $rep.$vues["erreur"];
		}
	}

    /**
     * S'inscrire sur le site
     *
     * Si l'inscription a fonctionnée, redirige sur la vue de connection
     * Si le pseudo est déjà pris, renvoie sur la vue d'inscription.
     */
	public function inscription()
	{
		global $rep;
		global $vues;

		try {
			if (isset($_POST['inputPseudo']) && isset($_POST['inputMDP'])) {
				$pseudo = Nettoyer::NettoyerString($_POST['inputPseudo']);
				$mdp = Nettoyer::NettoyerString($_POST['inputMDP']);
		
				ModelUtilisateur::creerUtil($pseudo, $mdp);
				require_once $rep.$vues["connection"];
			}
		}
		catch(Exception $e) {
			require_once $rep.$vues["inscription"];
			$dVueErreur[] = $e;
			require_once $rep.$vues["erreur"];
		}
	}
}