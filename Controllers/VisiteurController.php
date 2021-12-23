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
		require_once __DIR__.'/../Views/header.php';
		require_once(__DIR__.'/../Views/vue_principale.php');
	}

	public function afficherTaches()
	{
		
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
		if (isset($_POST['nomTache']) and isset($_POST['descTache']) and isset($_POST['idListe'])) {
			$idListe = Nettoyer::NettoyerInt($_POST['idListe']);
			$nomTache = Nettoyer::NettoyerString($_POST['nomTache']);
			$descTache = Nettoyer::NettoyerString($_POST['descTache']);

			ModelVisiteur::addTacheToListe($nomTache,$descTache, $idListe);
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
		try {
			if (isset($_POST['inputPseudo']) and isset($_POST['inputMDP'])) {
				$pseudo = Nettoyer::NettoyerString($_POST['inputPseudo']);
				$mdp = Nettoyer::NettoyerString($_POST['inputMDP']);

				ModelUtilisateur::connection($pseudo, $mdp);
				header('Location: index.php');
			}
		}
		catch (Exception $e) {
			echo $e;
			header('Location: Views/vue_connection.php');
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
     * S'inscrire sur le site
     *
     * Si l'inscription a fonctionnée, redirige sur la vue de connection
     * Si le pseudo est déjà pris, renvoie sur la vue d'inscription.
     */
	public function inscription()
	{
		try {
			if (isset($_POST['inputPseudo']) && isset($_POST['inputMDP'])) {
				$pseudo = Nettoyer::NettoyerString($_POST['inputPseudo']);
				$mdp = Nettoyer::NettoyerString($_POST['inputMDP']);
		
				ModelUtilisateur::creerUtil($pseudo, $mdp);
				header('Location: Views/vue_connection.php');
			}
		}
		catch(Exception $e) {
			header('Location: Views/vue_inscription.php');
		}
	}
}