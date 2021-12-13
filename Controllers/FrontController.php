<?php 			
			
class FrontController {	
			
	public function __construct() {
		$listeAction_User= array('deconnecter','creerListePriv');
				
		try{	
			$user_connected=MdlUser::isUser();
			
			$action=Nettoyer::NettoyerString($_POST['action']);
			
			if(in_array($action,$listeAction_User))
			{
				if($user_connected==null) {
					require("vue_connection.php");
				}
				else {
					new UtilisateurController();
				}	
			}		
				
			else	
			{	
				new VisiteurController();
			}	
		}		
		catch (Exception $e){
			$dVueErreur[]=$e;
			require('vue_erreur.php');
		}		
	}			
}				