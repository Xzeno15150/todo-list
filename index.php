<?php

require_once(__DIR__."/Config/Autoloader.php");

Autoloader::charger();

try {
	$user_connected = new Utilisateur(1, "Xzeno15150", "");
	
	if (isset($user_connected)) {
		new UtilisateurController();
	}
	else {
		new VisiteurController();
	}

} catch (Exception $e) {
	$dVueEreur[] = $e;
	require 'Views/vue_erreur.php';
	exit(1);
}




