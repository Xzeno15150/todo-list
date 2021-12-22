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

			$user = ModelUtilisateur::isUser();
			ModelUtilisateur::creerListePrivee($nom, $user);

			header('Location: index.php');

		}
	}

	public function deconnecter()
	{
		ModelUtilisateur::deconnection();
		header('Location: index.php');
	}
}