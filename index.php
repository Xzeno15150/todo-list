<?php
/**
 * Created by PhpStorm.
 * User: vigaillard2
 * Date: 17/11/21
 * Time: 13:07
 */
require('Views/vue_visiteur.php');
require ('utils.php');
require ('Connection.php');

$tab_error = [];
try {
    $con = new Connection($dsn, $usr, $pass);
}
catch (PDOException $e){
    echo ('Problème de connection à la base de données');

}
/*$title = 'Test PHP';
$text = 'ceci est la news ajoutée depuis le php';

$query = 'insert into News(title, text) values(:title, :text)';

$con->executeQuery($query, array(
    ':title'    => array($title, PDO::PARAM_STR),
    ':text'     => array($text, PDO::PARAM_STR)
));
*/



