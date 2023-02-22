<?php

namespace App\Models;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models

abstract class CoreModel
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;

    // Tu es OBLIGE dans les classes enfant de faire une méthode findAll()
    abstract public static function findAll();
    abstract public static function find(int $id);

    abstract public function update();

    abstract public function insert();
    abstract public function delete();


    /**
     * Methode pour faire persister un item en bdd qu'il soit en ajout ou en update
     * 
     * @return bool
     */
    public function save(){
        if($this->id === null){
            return $this->insert();
        }else{
            return $this->update();
        }
    }
    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
