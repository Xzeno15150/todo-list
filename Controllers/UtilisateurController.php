<?php 

class UtilisateurController extends VisiteurController
{
	
	public function __construct()
	{
		parent::__construct($action);
		switch ($action) {
			case 'creerListePriv':
				$this->creerListePrivee();
				break;
			case 'connecter':
				// code...
				break;
			case 'deconnecter':
				// code...
				break;
			default:
				// code...
				break;
		}
	}

	public function creerListePrivee()
	{
		$nom = $_POST['nomListePriv'];
		$nom = Nettoyer::NettoyerString($nom);

		$con = new Connection($dsn, $usr, $pass);
		$lg = new ListeGateway($con);

		$l = new Liste();

	}
}