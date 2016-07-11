<?php

$username = '';
$password = '';
$dsn = 'sqlite:'.__DIR__.'/model.db';
try {
$cnx = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
		die( "Erreur ! : " . $e->getMessage() );
}
	

