<?php

require_once(__DIR__."/Config/config.php");
require_once(__DIR__."/Config/Autoloader.php");

Autoloader::charger();

try {
	$con = new Connection($dsn, $usr, $pass);

	$lGateway = new ListeGateway($con);
	$nbpagespublics = $lGateway->getNbPagesPublics(10);
	$pagePublic = (isset($_GET['pagePublic'])) ? $_GET['pagePublic'] : 10;
	$pagePublic = Validation::validationPage($pagePublic, $nbpagespublics);
	$public_lists = $lGateway->getListsByPage($pagePublic, 10);

	$user_connected = new Utilisateur(1, "Xzeno15150", "TEST");
	$nbpagesprivees = $lGateway->getNbPagesPrivees(10, $user_connected);
	$pagePrivee = (isset($_GET['pagePrivee'])) ? $_GET['pagePrivee'] : 10;
	$pagePrivee = Validation::validationPage($pagePrivee, $nbpagesprivees);
	$private_lists = $lGateway->getListsByUserByPage($pagePrivee, 10, $user_connected);

	$current_liste = $lGateway->getListById(1);
	$current_tache = new Tache(NULL, 'Test 1', 'Ceci est la première Tâche de test', '2021-12-02', 0);
	$current_liste->ajoutTache($current_tache);
} catch (Exception $e) {
	$dVueEreur[] = $e;
	require 'Views/vue_erreur.php';
	exit(1);
}


//require 'Views/vue_liste.php';
require 'Views/vue_principale.php';




