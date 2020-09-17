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
      // UPDATE produits SET $array['nom'] = $this->nom, ...
      // LE FAIRE AVEC PREPARE
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
         return $this->pdo->query("DELETE produits WHERE 1");
      else{
         $stmt = $this->pdo->prepare("DELETE produits WHERE id = :id");
         var_dump($stmt);
         exit();
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
      $stmt->execute([':id' => $id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   /**
    * Sauvegarde d'un produit dans la base
    *
    * @return void
    */
   public function save()
   {
      // INSERT INTO produits (nom, desc, ...) VALUES ($this->nom, $this->desc)
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