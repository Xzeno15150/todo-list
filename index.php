<?php
require 'Utils/utils.php';
require 'DAL/Connection.php';
require 'DAL/ListeGateway.php';

try {
	$con = new Connection($dsn, $usr, $pass);

	$lGateway = new ListeGateway($con); 

	$all_lists = array(
		'1' => new Liste(1, "Test", false), 
		'2' => new Liste(2, "Test 2", false));
} catch (PDOException $e) {
	
}

require 'Views/vue_visiteur.php';




