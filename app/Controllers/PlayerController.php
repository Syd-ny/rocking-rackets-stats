<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * 
 * Player is a child of CoreModel
 */
class Player extends CoreModel
{

    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $ability;
    /**
     * @var float
     */
    private $serve;
    /**
     * @var int
     */
    private $strenght;
    /**
     * @var int
     */
    private $speed;
    /**
     * @var int
     */
    private $mentality;
    /**
     * @var int
     */
    private $double;
    /**
     * @var int
     */
    private $talent;
    /**
     * @var string
     */
    private $endurance;
    /**
     * @var string
     */
    private $hard;
    /**
     * @var string
     */
    private $clay;
    /**
     * @var string
     */
    private $grass;
    /**
     * @var float
     */
    private $indoor;
    /**
     * @var int
     */
    private $age;
    /**
     * @var int
     */
    private $agefactor;
    /**
     * @var int
     */
    private $agefactornow;
    /**
     * @var int
     */
    private $singlerating;
    /**
     * @var int
     */
    private $doublerating;
    /**
     * @var float
     */
    private $singlepotential;
    /**
     * @var int
     */
    private $doublepotential;
    /**
     * @var int
     */
    private $trainerskill;
    /**
     * @var int
     */
    private $bestrankingsingle;
    /**
     * @var int
     */
    private $bestrankingdouble;
    /**
     * @var int
     */
    private $weeksn1;
    /**
     * @var int
     */
    private $weeksn1double;
    /**
     * @var int
     */
    private $atp250single;
    /**
     * @var int
     */
    private $atp250double;
    /**
     * @var int
     */
    private $atp500single;
    /**
     * @var int
     */
    private $atp500double;
    /**
     * @var int
     */
    private $m1000single;
    /**
     * @var int
     */
    private $m1000double;
    /**
     * @var int
     */
    private $wtfsingle;
    /**
     * @var int
     */
    private $wtfdouble;
    /**
     * @var int
     */
    private $gssingle;
    /**
     * @var int
     */
    private $gsdouble;
    /**
     * @var int
     */
    private $overallsingle;
    /**
     * @var int
     */
    private $overalldouble;
    /**
     * @var int
     */
    private $overallboth;
    /**
     * @var int
     */
    private $status;



    public function delete(){
        
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "DELETE FROM players ";
        $sql .= "WHERE id = :id";

        $query = $pdo->prepare($sql);
        $result = $query->execute([
            ":id" => $this->id
        ]);

        if($result){

            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Méthode permettant de récupérer un enregistrement de la table Player en fonction d'un id donné
     *
     * @param int $playertId ID du produit
     * @return Product
     */
    public static function find(int $playerId)
    {
        // récupérer un objet PDO = connexion à la BDD
        $pdo = Database::getPDO();

        // on écrit la requête SQL pour récupérer le produit
        $sql = '
            SELECT *
            FROM players
            WHERE id = :id';

        // query ? exec ?
        // On fait de la LECTURE = une récupration => query()
        // si on avait fait une modification, suppression, ou un ajout => exec
        $query = $pdo->prepare($sql);

        $result = $query->execute([

            "id" => $playerId

        ]);

        // fetchObject() pour récupérer un seul résultat
        // si j'en avais eu plusieurs => fetchAll
        $player = $query->fetchObject('App\Models\Player');

        return $player;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table player
     *
     * @return Player[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `players`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $results;
    }

    /**
     * Récupérer les 5 dernier produits
     *
     * @return Product[]
     */
    public static function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM product
            ORDER BY created_at DESC LIMIT 5
        ';
        $pdoStatement = $pdo->query($sql);
        $products = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');

        return $products;
    }

    /**
     * Fait persister l'objet en bdd
     * @return bool
     */
    public function insert(){

        $pdo = Database::getPDO();
        $sql = "INSERT INTO product (name, description, picture, price, rate, status, brand_id, category_id, type_id) VALUES (:name, :description, :picture, :price, :rate, :status, :brand_id, :category_id, :type_id)";

        $query = $pdo->prepare($sql);

        $result = $query->execute([
            ":name" => $this->name,
            ":description" => $this->description,
            ":picture" => $this->picture,
            ":price" => $this->price,
            ':rate'=>  $this->rate,
            ':status'=>  $this->status,
            ':brand_id'=>  $this->brand_id,
            ':category_id'=>  $this->category_id,
            ':type_id'=>  $this->type_id,
        ]);

        if($result){
            $this->id = $pdo->lastInsertId();

            return true;

        }else{

            return false;
            
        }
    }

      /**
     * Fait persister l'objet en bdd pour une modification
     * @return bool
     */
    public function update(){

        $pdo = Database::getPDO();
        $sql = "UPDATE product ";

        $sql .= "SET name = :name, description = :description, picture = :picture, price = :price, rate = :rate, status = :status, brand_id = :brand_id, category_id = :category_id, type_id = :type_id, updated_at = NOW() ";

        $sql .= "WHERE id = :id";

        $query = $pdo->prepare($sql);

        $result = $query->execute([
            ":name" => $this->name,
            ":description" => $this->description,
            ":picture" => $this->picture,
            ":price" => $this->price,
            ':rate'=>  $this->rate,
            ':status'=>  $this->status,
            ':brand_id'=>  $this->brand_id,
            ':category_id'=>  $this->category_id,
            ':type_id'=>  $this->type_id,
            ':id' => $this->id
        ]);

        if($result){

            return true;

        }else{

            return false;
            
        }
    }

    
}
