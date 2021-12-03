<?php

/*try {
	$con = new Connection($dsn, $usr, $pass);

	$lGateway = new ListeGateway($con);
	$nbpagespublics = $lGateway->getNbPagesPublics(1);
	$pagePublic = (isset($_GET['pagePublic'])) ? $_GET['pagePublic'] : 1;
	$pagePublic = Validation::validationPage($pagePublic, $nbpagespublics);
	$all_lists = $lGateway->getListsByPage($pagePublic, 1);

	$user_connected = new Utilisateur(1, "Xzeno15150", "TEST");
	$nbpagesprivees = $lGateway->getNbPagesPrivees(1, $user_connected);
	$pagePrivee = (isset($_GET['pagePrivee'])) ? $_GET['pagePrivee'] : 1;
	$pagePrivee = Validation::validationPage($pagePrivee, $nbpagesprivees);
	$private_lists = $lGateway->getListsByUserByPage($pagePrivee, 1, $user_connected);

	$current_liste = $lGateway->getListById(1);
	$current_tache = new Tache(NULL, 'Test 1', 'Ceci est la première Tâche de test', '2021-12-02', 0);
	$current_liste->ajoutTache($current_tache);
} catch (Exception $e) {
	$dVueEreur[] = $e;
	require 'Views/vue_erreur.php';
	exit(1);
}*/

require_once(__DIR__."/Config/config.php");
require_once(__DIR__."/Config/Autoloader.php");


//require 'Views/vue_liste.php';
require 'Views/vue_visiteur.php';




