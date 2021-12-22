<?php

class VisiteurController
{	
	
	public function __construct($action)
	{
		try {
			switch ($action) {
				case 'afficherListes':
					$this->afficherListes();
					break;
				case 'afficherTaches' :
					$this->afficherTaches();
					break;



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



				case 'creerTache' :
					$this->creerTache();
					break;
				case 'checkTache':
					
					break;



				case 'connecter':
					$this->connecter();
					break;
				case 'inscription':
					$this->inscription();
					break;


				default:
					throw new Exception("Action inexistante", 1);
			}

		} catch (Exception $e) {
			$dVueEreur[] = $e;
			require 'Views/vue_erreur.php';
			exit(1);		
		}

	}
	public function afficherListes()
	{
		$pagePublic = 1;
		if (isset($_GET['pagePublic'])) 
		{
			$pagePublic = Nettoyer::NettoyerInt((int) $_GET['pagePublic']);
		}
		
		$nbpagespublics = ModelVisiteur::getNbPagesPublics();
		$pagePublic = Validation::validationPage($pagePublic,$nbpagespublics);
		$public_lists = ModelVisiteur::getListsPubliques($pagePublic);

		$user_connected = ModelUtilisateur::isUser();
		if ($user_connected != NULL) 
		{
			$pagePrivee = 1;
			if (isset($_GET['pagePrivee'])) {
				$pagePrivee = Nettoyer::NettoyerInt((int) $_GET['pagePrivee']);
			}
			
			$nbpagesprivees = ModelVisiteur::getNbPagesPrivees($user_connected);
			$pagePrivee = Validation::validationPage($pagePrivee, $nbpagesprivees);
			$private_lists = ModelVisiteur::getListsPrivee($pagePrivee, $user_connected);	
		}
		if (isset($_GET['idEdit'])) {
			$idEdit = Nettoyer::NettoyerInt((int) $_GET['idEdit']);
		}

		require_once __DIR__.'/../Views/header.php';
		require_once(__DIR__.'/../Views/vue_principale.php');
	}

	public function afficherTaches()
	{
		
	}

	public function creerListePub()
	{
		if(isset($_POST['nomListePub']))
		{
			$nomListe = Nettoyer::NettoyerString($_POST['nomListePub']);
			$liste = new Liste($nomListe);
			ModelVisiteur::addListePub($liste);
			$this->afficherListes();
		}
	}

	public function creerTache()
	{
		if (isset($_POST['nomTache']) and isset($_POST['descTache']) and isset($_POST['idListe'])) {
			$idListe = Nettoyer::NettoyerInt($_POST['idListe']);
			$nomTache = Nettoyer::NettoyerString($_POST['nomTache']);
			$descTache = Nettoyer::NettoyerString($_POST['descTache']);

			$tache = new Tache ($nomTache, $descTache);

			ModelVisiteur::addTacheToListe($tache, $idListe);
		}
	}

	public function supListe()
	{
		if (isset($_GET['id'])) 
		{
			$idListe = Nettoyer::NettoyerInt($_GET['id']);
			ModelVisiteur::removeListe($idListe);
			$this->afficherListes();
		}

	}

	public function connecter()
	{
		try {
			if (isset($_POST['inputPseudo']) and isset($_POST['inputMDP'])) {
				$pseudo = Nettoyer::NettoyerString($_POST['inputPseudo']);
				$mdp = Nettoyer::NettoyerString($_POST['inputMDP']);

				ModelUtilisateur::connection($pseudo, $mdp);
				$user_connected = ModelUtilisateur::isUser();
				header('Location: index.php');
			}
		}
		catch (Exception $e) {
			echo $e;
			header('Location: Views/vue_connection.php');
		}
		
	}

	public function checkListe()
	{
		if (isset($_GET['id']))  {
			$idListe = Nettoyer::NettoyerInt($_GET['id']);
			ModelVisiteur::checkListe($idListe);
			$this->afficherListes();
		}
	}

	public function editListe()
	{
		if (isset($_POST['idEdit']) && isset($_POST['editListeNom'])) {
			$idListe = Nettoyer::NettoyerInt((int) $_POST['idEdit']);
			$nomListe = Nettoyer::NettoyerString($_POST['editListeNom']);

			ModelVisiteur::modifyListe($idListe, $nomListe);
			$this->afficherListes();
		}
	}

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
?>