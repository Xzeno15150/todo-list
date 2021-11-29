<?php
require 'Utils/utils.php';
require 'DAL/Connection.php';
require 'DAL/ListeGateway.php';

try {
	$con = new Connection($dsn, $usr, $pass);

	$lGateway = new ListeGateway($con); 

	$all_lists = $lGateway->getListsByPage(1, 10);
} catch (PDOException $e) {
	echo $e;
}

require 'Views/vue_visiteur.php';




