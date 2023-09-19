<?php

// Je le range dans l'espace virtuel Model\Entities
namespace Model\Entities;

//  Je veux utiliser Entity qui est rangé dans App (similaire à "require")
use App\Entity;

// final class = ne pas pas être la mère de quelque chose. Par contre elle herite de la class Entity
final class Topic extends Entity
{
        // Liste des propriétés de la classe Topic selon le principe d'encapsulation (visibilité des elements au sein d'une classe)
        private $id;
        private $title;
        private $isLocked;
        private $topicCreationDate;
        private $user;
        private $categoryId;



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
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */
        public function setTitle($title)
        {
                $this->title = $title;

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

        public function getTopicCreationdate()
        {
                $formattedDate = $this->topicCreationDate->format("d/m/Y, H:i:s");
                return $formattedDate;
        }

        public function setTopicCreationdate($date)
        {
                $this->topicCreationDate = new \DateTime($date);
                return $this;
        }

        /**
         * Get the value of closed
         */
        public function getIsLocked()
        {
                return $this->isLocked;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */
        public function setIsLocked($isLocked)
        {
                $this->isLocked = $isLocked;

                return $this;
        }
        public function getCategoryId()
        {
                return $this->categoryId;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */
        public function setCategoryId($categoryId)
        {
                $this->categoryId = $categoryId;

                return $this;
        }

        public function __toString()
        {
                return $this->title;
        }
}
