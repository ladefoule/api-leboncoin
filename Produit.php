<?php 

class Produit
{
   private $nom;
   private $prix;
   private $description;
   private $emailContact;
   private $categorie;
   private $pdo;

   /**
    * On initialise la connexion à la base
    *
    * @param Array $array
    */
   public function __construct()
   {
      try {
         $pdo = new PDO("mysql:host=localhost;dbname=LEBONCOIN,dev,dev");
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
   public function delete(Int $id)
   {
      // DELETE FROM produits WHERE id = $id
   }

   /**
    * Récup des infos d'un produits
    *
    * @param Int $id
    * @return void
    */
   public function read(Int $id)
   {
      $resultatRequete = [];
      return json_encode($resultatRequete);
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
}