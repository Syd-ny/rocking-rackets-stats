<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel
{


    /**
     * @var string
     */
    private $pseudo;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $role;

    /**
     * @var int
     */
    private $status;

    /**
     * Methode qui permet de récupérer tous les utilisateurs en bdd
     * 
     * @return array - tableau d'objets user
     * 
     */
    public static function findAll()
    {
         // Je récupère mon instance de pdo
         $pdo = Database::getPDO();

        //  requete sql
         $sql = "SELECT * FROM app_user";

        //  on prépare
         $query = $pdo->prepare($sql);

        //  on execute
         $result = $query->execute();

        //  on récupère le résultat
         $users = $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);

         return $users;
    }

    /**
     * Méthode pour trouvé un utilisateur par son id
     * 
     * @param int $id id de l'user que je cherche
     * @return AppUser|false retourne l'user trouvé ou rien s'il existe pas
     */
    public static function find(int $id)
    {

    }

    public function update()
    {
    }
    /**
     * Méthode pour ajouter un utilisateur en bdd
     * 
     * @return bool
     */
    public function insert()
    {
         // Je récupère mon instance de pdo
         $pdo = Database::getPDO();

         $sql = "INSERT INTO app_user(pseudo, password, role, status) VALUES (:pseudo, :password, :role, :status)";

         $query = $pdo->prepare($sql);

         $result = $query->execute([
            ":pseudo" => $this->pseudo,
            ":password" => $this->password,
            ":role" => $this->role,
            ":status" => $this->status
         ]);

        //  Si la requete a fonctionné, j'injecte dans l'id de l'objet courant le dernier id ajouté en sql
         if($result){
            $this->id = $pdo->lastInsertId();
         }

         return $result;
    }
    public function delete()
    {
    }

    /**
     * Permet de retourner un utilisateur par son pseudo
     * 
     * @param string $pseudo  pseduo de l'utilisateur à chercher
     * @return AppUser|false
     */
    public static function findByPseudo(string $pseudo){
        // Je récupère mon instance de pdo
        $pdo = Database::getPDO();

        // Je crée ma requete sécurisé avec un paramètre
        $sql = "SELECT * FROM app_user WHERE pseudo = :pseudo";

        // Je la prépare
        $query = $pdo->prepare($sql);

        // Je l'execute en bindant les param
        $result = $query->execute([
            ":pseudo" => $pseudo
        ]);

        $user = $query->fetchObject(__CLASS__);

        return $user;
    }

    /**
     * Get the value of pseudo
     *
     * @return  string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @param  string  $pseudo
     *
     * @return  self
     */
    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    
    /**
     * Get the value of role
     *
     * @return  string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param  string  $role
     *
     * @return  self
     */
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     *
     * @return  self
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }
}
