<?php 

class UtilisateurController
{
	
	public function __construct($action)
	{
		switch ($action) {

			case 'creerListePriv':
				$this->creerListePrivee();
				break;
			
			case 'deconnecter':
				$this->deconnecter();
				break;

			default:
				throw new Exception("Action inexistante", 1);
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

	public function deconnecter()
	{
		ModelUtilisateur::deconnection();
	}
}