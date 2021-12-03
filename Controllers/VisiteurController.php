<?php

require 'Utils/utils.php'
require 'Utils/Nettoyer.php'
require 'DAL/ListeGateway.php'

/**
 * 
 */
class VisiteurController
{	
	
	public function __construct()
	{
		try {
			$action=$_REQUEST['action']
			switch ($action) {
				case 'creerListePub':
					$this->creerListePub();
					break;
				
				case 'creerTache' :
					$this->creerTache();
					break;

				case 'supListe':
					
					break;

				case 'checkListe':
					
					break;

				case 'checkTache':
					
					break;

				default:
					
					break;
			}	
		} catch (Exception $e) {
			$dVueEreur[] = $e;
			require 'Views/vue_erreur.php';
			exit(1);		
		}

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
		$nomTache = Nettoyer::NettoyerString($nomTache);
		$descTache = Nettoyer::NettoyerString($descTache);
		$tache = new Tache ($nomTache,$descTache,date());
	}
}

?>