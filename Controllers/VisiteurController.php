<?php

class VisiteurController
{	
	
	public function __construct($action)
	{
		try {
			switch ($action) {
				case 'afficherListes' :
					$this->afficherListes();
					break;
				case 'creerListePub':
					$this->creerListePub();
					break;
				
				case 'creerTache' :
					$this->creerTache();
					break;

				case 'supListe':
					$this->supListe();
					break;

				case 'checkListe':
					
					break;

				case 'checkTache':
					
					break;

				case 'connecter':

					break;

				case 'inscription':

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
		if (isset($_GET['pagePublic'])) 
		{
			$pagePublic = $_GET['pagePublic'];
			$nbpagespublics = ModelVisiteur::getNbPagesPublics();
			$pagePublic = Validation::validationPage($pagePublic,$nbpagespublics);
			$public_lists = ModelVisiteur::getListsPubliques($pagePublic);

			if (isset($user_connected) and isset($_GET['pagePrivee'])) 
			{
				$pagePrivee = $_GET['pagePrivee'];
				$nbpagesprivees = ModelVisiteur::getNbPagesPrivees($user_connected);
				$pagePrivee = Validation::validationPage($pagePrivee, $nbpagesprivees);
				$private_lists = ModelVisiteur::getListsPrivee($pagePrivee, $user_connected);	
			}

			require_once __DIR__.'/../Views/header.php';
			require_once(__DIR__.'/../Views/vue_principale.php');
		}
	}

	public function creerListePub()
	{
		if(isset($_POST['nomListePub']))
		{
			$nomListe = $_POST['nomListePub'];
			$nomListe = Nettoyer::NettoyerString($nomListe);
			$liste = new Liste($nomListe);
			ModelVisiteur::addListePub($liste);
			$this->afficherListes();
		}
	}

	public function creerTache()
	{
		if (isset($_POST['nomTache']) and isset($_POST['descTache']) and isset($_POST['idListe'])) {
			$nomTache = $_POST['nomTache'];
			$descTache = $_POST['descTache'];
			$idListe = $_POST['idListe'];
			$nomTache = Nettoyer::NettoyerString($nomTache);
			$descTache = Nettoyer::NettoyerString($descTache);

			$tache = new Tache ($nomTache,$descTache,date());

			ModelVisiteur::addTacheToListe($tache, $idListe);
		}
	}

	public function supListe()
	{
		if (isset($_POST['idList'])) 
		{
			$idListe=$_POST['idList'];
			ModelVisiteur::removeListe($idListe);
		}

	}
}
?>