<?php

// Je le range dans l'espace virtuel Model\Entities
namespace Model\Entities;

//  Je veux utiliser Entity qui est rangé dans App (similaire à "require")
use App\Entity;

// final class = ne pas pas être la mère de quelque chose. Par contre elle herite de la class Entity
final class Category extends Entity
{
    // Liste des propriétés de la classe Category selon le principe d'encapsulation (visibilité des elements au sein d'une classe)
    private $id;
    private $categoryName;


    public function __construct($data)
    {
        //Hydrate dans l'ordre des propriétés
        $this->hydrate($data);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }


    public function __toString()
    {
        return $this->categoryName;
    }
}
