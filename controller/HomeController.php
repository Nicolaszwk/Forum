<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;

// implements = oblige la classe à avoir des fonctions qui ont le meme noms que ici dans ControllerInterface 
class HomeController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        $categoryManager = new CategoryManager;
        $topicManager = new TopicManager;
        $categories = $categoryManager->findAll();
        $topics = $topicManager;
        $title = "Page d'accueil";

        return [
            "view" => VIEW_DIR . "/home.php",
            "data" => [
                "topics" => $topics,
                "categories" => $categories,
                "title" => $title
            ]
        ];
        
    }

    /* public function users()
    {

        $this->restrictTo("ROLE_USER");
        $manager = new UserManager();
        $users = $manager->findAll(['registerdate', 'DESC']);

        return [

            "view" => VIEW_DIR . "security/users.php",
            "data" => [
                "users" => $users
            ]

        ];
    }*/
    public function forumRules()
    {

        return [
            "view" => VIEW_DIR . "rules.php"
        ];
    }

    public function listUsers()
    {
        // Crée une instance du gestionnaire d'utilisateurs (UserManager).
        $manager = new UserManager;
    
        // Utilise le gestionnaire d'utilisateurs pour récupérer la liste de tous les utilisateurs.
        $users = $manager->findAll();
    
        // Retourne un tableau associatif qui spécifie la vue à afficher et les données à passer à cette vue.
        return [
            "view" => VIEW_DIR . "forum/listUsers.php",
            "data" => [
                "users" => $users
            ]
        ];
    }
    
}
