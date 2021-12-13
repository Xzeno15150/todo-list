<?php 			
			
class FrontController {	
			
	public function __construct() {
		$listeAction_User= array('deconnecter','creerListePriv');
				
		try{	
			$user_connected = ModelUtilisateur::isUser();
			
			if (!isset($_REQUEST['action'])) {
				$action = "afficherListes";
			}
			else{
				$action = $_REQUEST['action'];
			}
			$action=Nettoyer::NettoyerString($action);
			
			if(in_array($action,$listeAction_User))
			{

				if($user_connected==null) {
					require("vue_connection.php");
				}
				else {
					new UtilisateurController($action);
				}	
			}	
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