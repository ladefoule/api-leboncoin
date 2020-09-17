<?php 

class Produit
{
   private $nom;
   private $prix;
   private $description;
   private $emailContact;
   private $categorie;
   private PDO $pdo;

   /**
    * On initialise la connexion à la base
    *
    * @param Array $array
    */
   public function __construct()
   {
      try {
         $pdo = new PDO("mysql:host=localhost;dbname=LEBONCOIN",'dev','dev');
      } catch (Exception $e) {
         die("Erreur : La base de données n'éxiste pas -- Merci de la créer");
      }
      $this->pdo = $pdo;
   }

   /**
    * Initialisation des paramètres
    *
    * @param Array $array
    * @return void
    */
   public function init(Array $array)
   {
      $this->nom = $array['nom'];
      $this->prix = $array['prix'];
      $this->categorie = $array['categorie'];
      $this->emailContact = $array['emailContact'];
      $this->description = $array['description'];
   }

   /**
    * Suppression d'un produit
    *
    * @param Int $id
    * @return void
    */
   public function delete(Int $id = 0)
   {
      if($id == 0)
         return $this->pdo->query("DELETE FROM produits WHERE 1");
      else{
         $stmt = $this->pdo->prepare("DELETE FROM produits WHERE id = :id");
         return $stmt->execute([':id' => $id]);
      }
   }

   /**
    * Récup des infos d'un produits
    *
    * @param Int $id
    * @return void
    */
   public function read(Int $id)
   {
      $stmt = $this->pdo->prepare("SELECT * FROM produits WHERE id = :id");
      $result = $stmt->execute([':id' => $id]);
      if(!$result)
         return false;
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   /**
    * Sauvegarde d'un produit dans la base
    *
    * @return void
    */
   public function save()
   {
      $stmt = $this->pdo->prepare("INSERT INTO produits SET nom = :nom, description = :description, email_contact = :emailContact, prix = :prix, categorie = :categorie");
      $result = $stmt->execute([
         'nom' => $this->nom,
         'prix' => $this->prix,
         'categorie' => $this->categorie,
         'emailContact' => $this->emailContact,
         'description' => $this->description
      ]);
   }

   public function minMax($min, $max)
   {
      if($min != -1 && $max == -1){
         $stmt = $this->pdo->prepare("SELECT * FROM produits WHERE prix >= :min order by prix asc");
         $result = $stmt->execute([':min' => $min]);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }else if($max != -1 && $min == -1){
         $stmt = $this->pdo->prepare("SELECT * FROM produits WHERE prix <= :max order by prix asc");
         $result = $stmt->execute([':max' => $max]);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }else {
         $stmt = $this->pdo->prepare("SELECT * FROM produits WHERE prix <= :max AND prix >= :min order by prix asc");
         $result = $stmt->execute([':max' => $max, ':min' => $min]);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
   }

   /**
    * Liste de tous les produits
    *
    * @return void
    */
    public function all()
    {
         return $this->pdo->query("SELECT * FROM produits WHERE 1")->fetchAll(PDO::FETCH_ASSOC);
    }
}