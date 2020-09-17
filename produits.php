<?php 

// var_dump($_SERVER);

// header('Access-Control-Allow-Methods: GET, POST');

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
$min = $_GET['min'] ?? -1;
$max = $_GET['max'] ?? -1;

// Pour récupérer le méthode de la requête
$method = $_SERVER['REQUEST_METHOD'];
$produit = new Produit();

switch ($method) {
   case 'GET':
      if($id == NONRENSEIGNE){
         if($min == -1 && $max == -1 )
            $produits = $produit->all();
         else
            $produits = $produit->minMax($min, $max);
         echo json_encode($produits);
      }else{
         $resultat = $produit->read($id);
         if($resultat){
            header('HTTP/1.0 200 OK');
            echo json_encode($resultat);
         }else {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode('Produit introuvable.');
         }
      }
      break;

   case 'POST':
      if($id != NONRENSEIGNE){
         header('HTTP/1.0 400 Bad Request');
         echo json_encode('Mauvaise requête.');
      }else{
         $array = [
            'nom' => $_POST['nom'] ?? NULL,
            'prix' => $_POST['prix'] ?? NULL,
            'categorie' => $_POST['categorie'] ?? NULL,
            'emailContact' => $_POST['email_contact'] ?? NULL,
            'description' => $_POST['description'] ?? NULL
         ];

         $produit->init($array);
         $produit->save();

         header('HTTP/1.0 200 OK');
         echo json_encode('Insertion OK.');
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