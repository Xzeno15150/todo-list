<?php
require 'Utils/utils.php';
require 'DAL/Connection.php';
require 'DAL/ListeGateway.php';

try {
	$con = new Connection($dsn, $usr, $pass);

	$lGateway = new ListeGateway($con); 

	$all_lists = $lGateway->getListsByPage(1, 10);

	$nbpages = 10;
	$page = 2;
	$user_connected = 'te';
} catch (PDOException $e) {
	$dVueEreur = $e;
	require 'Views/vue_erreur.php';

}

require 'Views/vue_visiteur.php';




