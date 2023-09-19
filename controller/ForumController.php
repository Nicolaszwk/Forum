<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;

class ForumController extends AbstractController implements ControllerInterface
{



    public function index()
    {

        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findAll(["creationdate", "DESC"])
            ]
        ];
    }

    /*************Category*********************/

    //Liste des catégories
    public function listCategories()
    {
        //Instanciation du manager associé à category
        $manager = new CategoryManager;

        //La fonction permet de répertorier toute les catégories
        $categories = $manager->findAll();

        //Retoune la vue menant à la liste des catégories
        return [
            "view" => VIEW_DIR . "forum/listCategories.php",

            //Retourne un tableau associatif contenant des informations sur la vue et les données à afficher.
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    //Formulaire d'ajout d'une categorie
    public function addCategoryForm($id)
    {

        $manager = new CategoryManager;

        //La fonction permet ici de trouver une catégorie par son id
        $category = $manager->findOneById($id);

        return [
            "view" => VIEW_DIR . "forum/addCategoryForm.php",
            "data" => [
                "category" => $category
            ]
        ];
    }


    public function addCategory()
    {
        // Récupére le nom de la catégorie à partir des données POST, en le filtrant pour éviter les caractères spéciaux.
        $categoryName = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Crée une instance du gestionnaire de catégories.
        $manager = new CategoryManager;

        // Appele la méthode du gestionnaire pour ajouter la nouvelle catégorie avec le nom spécifié.
        $addCategory = $manager->add(["categoryName" => $categoryName]);

        // Redirige l'utilisateur vers une autre page après avoir ajouté la catégorie.
        return $this->redirectTo('Nicolas_Zwickel', 'Forum', 'index'); // Redirection vers l'index du forum, par exemple.
    }


    public function deleteCategory()
    {
        // Crée une instance du gestionnaire de catégories.
        $manager = new CategoryManager;

        // Récupére l'ID de la catégorie à supprimer à partir des paramètres GET.
        $categoryId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        // Appele la méthode de gestionnaire pour supprimer la catégorie.
        $deleteCategory = $manager->delete($categoryId);

        // Retourne un tableau associatif indiquant la vue à afficher après la suppression.
        return [
            "view" => VIEW_DIR . "security/listTopic.php", // Il semble que vous redirigiez vers la vue "listTopic.php".
        ];
    }

    public function updateCategoryForm($id)
    {
        // Crée une instance du gestionnaire de catégories.
        $categoryManager = new CategoryManager;

        // Utilise le gestionnaire de catégories pour trouver la catégorie par son ID.
        $category = $categoryManager->findOneById($id);

        // Retourne un tableau associatif avec deux éléments :
        // 1. La vue à afficher pour le formulaire de mise à jour.
        // 2. Les données nécessaires pour remplir le formulaire, ici la catégorie à mettre à jour.
        return [
            "view" => VIEW_DIR . "forum/updateCategoryForm.php",
            "data" => [
                "category" => $category
            ]
        ];
    }


    public function updateCategory($id)
    {
        // Récupére le nouveau nom de la catégorie depuis le formulaire.
        $categoryName = filter_input(INPUT_POST, "newName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Crée une instance du gestionnaire de catégories.
        $categoryManager = new CategoryManager;

        // Utilise le gestionnaire de catégories pour mettre à jour la catégorie spécifiée par son ID.
        // Passez l'ID de la catégorie et le nouveau nom comme données de mise à jour.
        $updateCategory = $categoryManager->update(["id" => $id, "categoryName" => $categoryName]);

        // Après avoir effectué la mise à jour, redirige l'utilisateur vers la liste des catégories.
        return $this->redirectTo('forum', 'listCategories');
    }

    public function searchCategory()
    {
        // Récupére le terme de recherche depuis le formulaire, filtré pour la sécurité.
        $searchTerm = filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($searchTerm) {
            // Crée une instance du gestionnaire de catégories.
            $categoryManager = new CategoryManager();

            // Utilise le gestionnaire de catégories pour rechercher des catégories qui correspondent au terme de recherche.
            // Utilise le terme de recherche pour rechercher des catégories partiellement similaires.
            $searchResults = $categoryManager->searchCategory('%' . $searchTerm . '%');

            // Après avoir obtenu les résultats de la recherche, retourne la vue et les données associées.
            // La vue "searchedCategories.php" est utilisée pour afficher les résultats de la recherche.
            return [
                "view" => VIEW_DIR . "forum/searchedCategories.php",
                "data" => [
                    "searchResults" => $searchResults
                ]
            ];
        }
    }

    /*************Topic*********************/

    public function listTopics($id)
    {
        // Crée une instance du gestionnaire de sujets (topics).
        $topicManager = new TopicManager;

        // Utilise le gestionnaire de sujets pour rechercher les sujets liés à la catégorie spécifiée par son ID.
        $topics = $topicManager->findTopicsByCatagoryId($id);

        // Crée une instance du gestionnaire de catégories.
        $categoryManager = new CategoryManager;

        // Utilise le gestionnaire de catégories pour obtenir les détails de la catégorie spécifiée par son ID.
        $category = $categoryManager->findOneById($id);

        // Retourne les résultats sous forme de tableau associatif qui inclut la vue à afficher et les données associées.
        // Utilise la vue "listTopics.php" pour afficher la liste des sujets associés à la catégorie.
        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topics,
                "category" => $category
            ]
        ];
    }


    public function addTopicForm($id)
    {
        // Crée une instance du gestionnaire de catégories.
        $categoryManager = new CategoryManager;

        // Utilise le gestionnaire de catégories pour obtenir les détails de la catégorie spécifiée par son ID.
        $category = $categoryManager->findOneById($id);

        // Retourne les résultats sous forme de tableau associatif qui inclut la vue à afficher et les données associées.
        // Utilise la vue "addTopicForm.php" pour afficher le formulaire d'ajout de sujet dans la catégorie spécifiée.
        return [
            "view" => VIEW_DIR . "forum/addTopicForm.php",
            'data' => [
                'category' => $category
            ]
        ];
    }


    public function addTopic()
    {
        // Récupére le titre du sujet, l'ID de la catégorie et le message du post à partir des données POST.
        $topicTitle = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categoryId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $postMessage = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Crée des instances des gestionnaires de sujets (TopicManager) et de messages (PostManager).
        $topicManager = new TopicManager;
        $postManager = new PostManager;

        // Ajoute le nouveau sujet en utilisant le gestionnaire de sujets et obtenez l'ID du sujet ajouté.
        $addTopic = $topicManager->add(["title" => $topicTitle, "category_id" => $categoryId]);

        // Ajoute le premier message (post) à ce sujet en utilisant le gestionnaire de messages.
        // Utilise l'ID du sujet ajouté précédemment pour lier le message au sujet.
        $addMessage = $postManager->add(["message" => $postMessage, "topic_id" => $addTopic]);

        // Redirige l'utilisateur vers une autre page, généralement la page d'accueil du forum.
        return $this->redirectTo('Nicolas_Zwickel', 'Forum', 'index');
    }


    public function deleteTopic()
    {
        // Récupére l'ID du sujet à supprimer depuis la requête GET.
        $topicId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        // Crée une instance du gestionnaire de sujets (TopicManager).
        $topicManager = new TopicManager;

        // Appele la méthode de suppression du gestionnaire de sujets pour supprimer le sujet.
        $deleteTopic = $topicManager->delete($topicId);

        // Redirige l'utilisateur vers une la page affichant la list des topics
        return [
            "view" => VIEW_DIR . "security/listTopics.php",
        ];
    }


    public function lockTopic()
    {
        // Récupére l'ID du sujet à verrouiller depuis la requête GET.
        $topicId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        // Crée une instance du gestionnaire de sujets (TopicManager).
        $topicManager = new TopicManager;

        // Utilise le gestionnaire de sujets pour mettre à jour le sujet et le verrouiller.
        $lockTopic = $topicManager->update(["id" => $topicId, "isLocked" => 1]);

        // Redirige l'utilisateur vers une la page affichant la list des topics
        return $this->redirectTo("index.php?ctrl=forum&action=listcategories");
    }

    public function unlockTopic()
    {
        // Récupére l'ID du sujet à déverrouiller depuis la requête GET.
        $topicId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        // Crée une instance du gestionnaire de sujets (TopicManager).
        $topicManager = new TopicManager;

        // Utilise le gestionnaire de sujets pour mettre à jour le sujet et le déverrouiller.
        $lockTopic = $topicManager->update(["id" => $topicId, "isLocked" => 0]);

        // Redirige l'utilisateur vers une la page affichant la list des topics
        return $this->redirectTo("index.php?ctrl=forum&action=listcategories");
    }


    /*************Post*********************/

    public function listPosts($id)
    {
        // Crée une instance du gestionnaire de messages (PostManager).
        $manager = new PostManager;

        // Utilise le gestionnaire de messages pour trouver tous les messages associés à un sujet spécifique (identifié par $id).
        $posts = $manager->findPostsByTopicId($id);

        // Crée une instance du gestionnaire de sujets (TopicManager).
        $topicManager = new TopicManager;

        // Utilise le gestionnaire de sujets pour trouver les informations sur le sujet spécifique (identifié par $id).
        $topic = $topicManager->findOneById($id);

        // Retourne un tableau associatif contenant le nom de la vue à afficher et les données à transmettre à cette vue.
        return [
            "view" => VIEW_DIR . "forum/listPosts.php", // Nom du fichier de vue à afficher.
            "data" => [
                "posts" => $posts, // Les messages associés au sujet.
                "topic" => $topic  // Les informations sur le sujet lui-même.
            ]
        ];
    }


    public function addPostForm($id)
    {
        // Crée une instance du gestionnaire de sujets (TopicManager).
        $topicManager = new TopicManager;

        // Utilise le gestionnaire de sujets pour trouver les informations sur le sujet spécifique (identifié par $id).
        $topic = $topicManager->findOneById($id);

        // Retourne un tableau associatif contenant le nom de la vue à afficher et les données à transmettre à cette vue.
        return [
            "view" => VIEW_DIR . "forum/addPostForm.php", // Nom du fichier de vue à afficher (le formulaire d'ajout de message).
            'data' => [
                'topic' => $topic  // Les informations sur le sujet auquel l'utilisateur souhaite ajouter un message.
            ]
        ];
    }


    public function addPost($id)
    {
        // Récupére le message du post soumis dans le formulaire.
        $postMessage = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Récupére l'identifiant du sujet auquel le post sera associé depuis la requête GET.
        $topicId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        // Crée une instance du gestionnaire de messages (PostManager).
        $manager = new PostManager;

        // Utilise le gestionnaire de messages pour ajouter le nouveau message dans la base de données.
        $addPost = $manager->add(["message" => $postMessage, "topic_id" => $topicId]);

        // Redirige l'utilisateur vers la liste des messages (posts) du sujet auquel il a ajouté un message.
        return $this->redirectTo("forum", "listPosts", $id);
    }


    public function deletePost()
    {
        // Récupére l'identifiant du message (post) à supprimer depuis la requête GET.
        $postId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        // Crée une instance du gestionnaire de messages (PostManager).
        $postManager = new PostManager;

        // Utilise le gestionnaire de messages pour trouver le message à supprimer par son identifiant.
        $searchId = $postManager->findOneById($postId);

        // Récupére l'identifiant du sujet auquel appartient ce message.
        $topicId = $searchId->getTopic()->getId();

        // Utilise le gestionnaire de messages pour supprimer le message de la base de données.
        $deletePost = $postManager->delete($postId);

        // Redirige l'utilisateur vers la liste des messages (posts) du sujet auquel appartenait le message supprimé.
        return $this->redirectTo("forum", "listPosts", $topicId);
    }
}
