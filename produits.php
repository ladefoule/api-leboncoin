<?php 
require './Classe/Produit.php';

// On définit le header de retour qui sera du JSON
header('Content-Type: application/json');

// Les différents retours HTTP possibles
// header('HTTP/1.0 200 OK');
// header('HTTP/1.0 404 Not Found');
// header('HTTP/1.0 405 Method Not Allowed');

// if(!isset($_GET['action'])){
//    header('HTTP/1.0 400 Bad Request');
//    echo json_encode("400 Bad Request");
//    exit();
// }

const NONRENSEIGNE = 'alpha';

$id = $_GET['id'] ?? NONRENSEIGNE;

// Pour récupérer le méthode de la requête
$method = $_SERVER['REQUEST_METHOD'];
$produit = new Produit();

switch ($method) {
   case 'GET':
      // if($method != 'GET'){
      //    header('HTTP/1.0 401 Unauthorized');
      //    echo json_encode("401 Unauthorized");
      //    exit();
      // }
      header('HTTP/1.0 200 OK');
      if($id == NONRENSEIGNE){
         $produits = $produit->all();
         echo json_encode($produits);
      }else{
         // echo json_encode('LISTE D\'UN PRODUIT : => ');
         header('Content-Type: application/html');
         var_dump($produit->read($id));
         exit();
      }
      break;

   case 'DELETE':
      header('HTTP/1.0 200 OK');
      if($id == NONRENSEIGNE){
         echo json_encode('SUPPRESSION DE TOUS LES PRODUITS : => ');
      }else{
         echo json_encode('SUPPRESSION D\'UN PRODUIT : => ');
      }
      break;
   
   default:
      header('HTTP/1.0 405 Method Not Allowed');
      echo json_encode('Méthode non prise en charge !');
      break;
}