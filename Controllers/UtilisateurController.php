<?php 

class UtilisateurController
{
	
	public function __construct()
	{
		$action = $_REQUEST['action'];
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
				new VisiteurController();
				break;
		}
	}

	public function creerListePrivee()
	{
		if (isset($_POST['nomListePriv'])) {
			$nom = $_POST['nomListePriv'];
			$nom = Nettoyer::NettoyerString($nom);
	
			$con = new Connection($dsn, $usr, $pass);
			$lg = new ListeGateway($con);
	
			$liste = new Liste($nom, null, 0, $user_connected->getId());
			$lg->creerListePrivee($liste);
		}
	}
}