<?php

class VisiteurController
{	
	
	public function __construct()
	{
		try {
			$action=$_REQUEST['action']
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

				default:
					throw new Exception("Action inexistante", 1);
					
					break;
			}	
		} catch (Exception $e) {
			$dVueEreur[] = $e;
			require 'Views/vue_erreur.php';
			exit(1);		
		}

	}
	public function afficherListes()
	{
		$page=$_GET['page'];
		$page=Validation::validationPage($page,$nbListByPage);
		$con = new Connection($dsn, $username, $password);
		$lg = new ListeGateway($con);
		$public_lists=$lg->getListsByPage($page,$nbListByPage);
		require_once('vue_principale.php');
	}

	public function creerListePub()
	{
		$nomListe = $_POST['nomListePub'];
		$nomListe = Nettoyer::NettoyerString($nomListe);
		$liste = new Liste($nomListe);
		$con = new Connection($dsn, $username, $password);
		$lg = new ListeGateway($con);
		$lg->createListePublic($liste);
	}

	public function creerTache()
	{
		$nomTache = $_POST['nomTache'];
		$descTache = $_POST['descTache'];
		$idListe = $_POST['idListe'];
		$nomTache = Nettoyer::NettoyerString($nomTache);
		$descTache = Nettoyer::NettoyerString($descTache);
		$tache = new Tache ($nomTache,$descTache,date());
		$con = new Connection($dsn, $username, $password);
		$lt = new ListeTache($con);
		$tache = new Tache($nomTache,$descTache,date());
		$lt->creerTache($tache,$idListe);	
	}

	public function supListe()
	{
		$idListe=$_POST['idList'];
		$con = new Connection($dsn, $username, $password);
		$lg = new ListeGateway($con);
		$lg->deleteListeById($idListe);

	}
}
?>