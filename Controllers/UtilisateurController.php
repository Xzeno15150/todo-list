<?php

/**
 * Classe UtilisateurController
 */
class UtilisateurController
{
    /**
     * Constructeur de UtilisateurController
     *
     * Appel la méthode associée à l'action demandée
     * @param string $action Action demandée
     * @throws Exception Envoi une exception si l'action demandée n'existe pas
     */
	public function __construct(string $action)
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
		}
	}

    /**
     * Création d'une Liste privée
     */
	public function creerListePrivee()
	{
		if (isset($_POST['nomListePriv'])) {
			$nom = $_POST['nomListePriv'];
			$nom = Nettoyer::NettoyerString($nom);

            // Instance de l'Utilisateur connecté
			$user = ModelUtilisateur::isUser();
			ModelUtilisateur::creerListePrivee($nom, $user);

			header('Location: index.php');
		}
	}

    /**
     * Déconnection de l'Utilisateur connecté
     */
	public function deconnecter()
	{
		ModelUtilisateur::deconnection();
		header('Location: index.php');
	}
}