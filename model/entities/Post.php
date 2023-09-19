<?php

// Je le range dans l'espace virtuel Model\Entities
namespace Model\Entities;

//  Je veux utiliser Entity qui est rangé dans App (similaire à "require")
use App\Entity;

// final class = ne pas pas être la mère de quelque chose. Par contre elle herite de la class Entity
final class Post extends Entity
{
    // Liste des propriétés de la classe Topic selon le principe d'encapsulation (visibilité des elements au sein d'une classe)
    private $id;
    private $message;
    private $postCreationDate;
    private $topic;
    private $user;



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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }


    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getPostCreationdate()
    {
        $formattedDate = $this->postCreationDate->format("d/m/Y, H:i:s");
        return $formattedDate;
    }

    public function setPostCreationdate($date)
    {
        $this->postCreationDate = new \DateTime($date);
        return $this;
    }
    public function __toString()
    {
        return $this->message;
    }
}
