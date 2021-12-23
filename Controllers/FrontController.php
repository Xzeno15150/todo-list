<?php

/**
 * Classe FrontController
 *
 * Classe qui permet de gérer les actions entre les autres controllers
 */
class FrontController {

    /**
     * Constructeur de FrontController
     *
     * Il est le corps de la classe, puisque toute action est faite ici
     * Test l'action demandée appartient pour savoir à quel controller elle appartient.
     * Elle gère aussi les éventuelles Exceptions lancées.
     */
	public function __construct() {
        // Liste des actions du rôle Utilisateur
		$listeAction_User= array('deconnecter','creerListePriv');
				
		try{
            // Test si l'utilisateur s'est déjà connecté (via la session)
			$user_connected = ModelUtilisateur::isUser();

            // 'afficherListes' est l'action par défaut
			if (!isset($_REQUEST['action'])) {
				$action = "afficherListes";
			}
			else{
				$action = Nettoyer::NettoyerString($_REQUEST['action']);
			}

            // Si l'action est une action Utilisateur
			if(in_array($action,$listeAction_User))
			{
                // Si pas connecté, appel à la vue de connection
				if($user_connected == NULL) {
					require("vue_connection.php");
				}
				else {
					new UtilisateurController($action);
				}	
			}
            // Si l'action n'appartient à aucun role (rôle Visiteur par défaut)
			else	
			{	
				new VisiteurController($action);
			}	
		}		
		catch (Exception $e){
			$dVueErreur[]=$e;
			require('vue_erreur.php');
		}		
	}			
}				