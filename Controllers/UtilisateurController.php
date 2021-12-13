<?php 

class UtilisateurController extends VisiteurController
{
	
	public function __construct()
	{
		switch ($action) {
			case 'creerListePriv':
				$this->creerListePrivee();
				break;
			
			case 'deconnecter':
				// code...
				break;
			default:
				parent::__construct($action);
				break;
		}
	}

	public function creerListePrivee()
	{
		$nom = $_POST['nomListePriv'];
		$nom = Nettoyer::NettoyerString($nom);

		$con = new Connection($dsn, $usr, $pass);
		$lg = new ListeGateway($con);

		$liste = new Liste($nom, null, 0, $user_connected->getId());
		$lg->creerListePrivee($liste);
	}
}