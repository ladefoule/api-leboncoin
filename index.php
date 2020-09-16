<?php 

// On définit le header de retour qui sera du JSON
header('Content-Type: application/json');

// Les différents retours HTTP possibles
header('HTTP/1.0 200 OK');


header('HTTP/1.0 404 Not Found');
header('HTTP/1.0 405 Method Not Allowed');

if(!isset($_GET['action'])){
   header('HTTP/1.0 400 Bad Request');
   echo json_encode("400 Bad Request");
   exit();
}

$action = $_GET['action'];

// Pour récupérer le méthode de la requête
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
   case 'all':
      if($method != 'GET'){
         header('HTTP/1.0 401 Unauthorized');
         echo json_encode("401 Unauthorized");
         exit();
      }
      echo json_encode('LISTE DES PRODUITS : => ');
      break;
   
   default:
      # code...
      break;
}