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
      header('HTTP/1.0 200 OK');
      if($id == NONRENSEIGNE){
         $produits = $produit->all();
         echo json_encode($produits);
      }else{
         echo json_encode($produit->read($id));
      }
      break;

   case 'DELETE':
      if($id == NONRENSEIGNE){
         $ok = $produit->delete();
         if($ok){
            header('HTTP/1.0 200 OK');
            echo json_encode("Suppression de tous les produits.");
         }else {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode("Erreur lors de la suppression.");
         }
      }else{
         $ok = $produit->delete($id);
         if($ok){
            header('HTTP/1.0 200 OK');
            echo json_encode("Suppression de l'ID : $id");
         }else {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode("Produit introuvable.");
         }
      }
      break;
   
   default:
      header('HTTP/1.0 405 Method Not Allowed');
      echo json_encode('Méthode non prise en charge !');
      break;
}