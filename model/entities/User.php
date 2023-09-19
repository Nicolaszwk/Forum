<?php

// Je le range dans l'espace virtuel Model\Entities
namespace Model\Entities;

//  Je veux utiliser Entity qui est rangé dans App (similaire à "require")
use App\Entity;

// final class = ne pas pas être la mère de quelque chose. Par contre elle herite de la class Entity
final class User extends Entity
{
    // Liste des propriétés de la classe Topic selon le principe d'encapsulation (visibilité des elements au sein d'une classe)
    private $id;
    private $email;
    private $pseudo;
    private $password;
    private $role;
    private $isBanned;
    private $signUpDate;


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

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /*
    * Get the value of role
	 */
	public function getRole()
	{
		return json_decode($this->role);
	}

 

	/**
	 * Set the value of role
	 *
	 * @return  self
	 */
	public function setRole($role)
	{
		$this->role = json_encode($role);

		return $this;
	}

 
	public function hasRole($role)
	{
		$result = $this->getRole() == json_encode($role);
		return $result;
	}

    public function getIsBanned()
    {
        return $this->isBanned;
    }

    /**
     * Set the value of closed
     *
     * @return  self
     */
    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    public function getSignUpDate()
    {
        $formattedDate = $this->signUpDate->format("d/m/Y, H:i:s");
        return $formattedDate;
    }

    public function setSignUpdate($date)
    {
        $this->signUpDate = new \DateTime($date);
        return $this;
    }

    public function __toString()
    {
        return $this->pseudo;
    }
}
