<?php 

// On définit le header de retour qui sera du JSON
header('Content-Type: application/json');

// Les différents retours HTTP possibles
header('HTTP/1.0 200 OK');
header('HTTP/1.0 400 Bad Request');
header('HTTP/1.0 401 Unauthorized');
header('HTTP/1.0 404 Not Found');
header('HTTP/1.0 405 Method Not Allowed');

// Pour récupérer le méthode de la requête
$_SERVER['REQUEST_METHOD'];