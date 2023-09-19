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
class SecurityController extends AbstractController implements ControllerInterface
{

    public function disconnect()
    {
        unset($_SESSION['user']);
        Session::addFlash('success', 'Vous êtes bien déconnecté !');
        return $this->redirectTo("index.php?ctrl=home");
    }

    public function signup()
    {

        if (isset($_POST['submit'])) {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmedPassword = filter_input(INPUT_POST, "confirmedPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        $userManager = new UserManager;
        $userBdd = $userManager->findOneByUsername($username);
        $emailBdd = $userManager->findOneByEmail($email);

        // {12,}: doit comporter minimum 12 caractères
        // (?=.*?[A-Z]): doit comporter au moins une lettre majuscule
        // (?=.*?[a-z]): doit comporter au moins une lettre minuscule
        //(?=.*?[0-9]): doit comporter au moins un chiffre
        //(?=.*?[#?!@$%^&*-]): doit comporter au moins un caractère spécial
        $regex = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{12,}$/';

        if ($userBdd) {
            echo "Username already used";
        } elseif ($emailBdd) {
            echo "Email already used";
        } elseif (!preg_match($regex, $password)) {
            echo "Le mot de passe doit contenir minimum 12 caractères, une lettre majuscule, une lettre minuscule et un symbole";
        } elseif ($password != $confirmedPassword) {
            echo "Les mots de passe ne correspondent pas";
        } elseif (!$userBdd && !$emailBdd && $password === $confirmedPassword) {

            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

            $signup = $userManager->add(["email" => $email, "pseudo" => $username, "passWord" => $passwordHashed, 'role' => json_encode("ROLE_USER")]);

            return $this->redirectTo("index.php?ctrl=home");
        }
    }

    public function login()
    {

        if (isset($_POST['submit'])) {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }


        $userManager = new UserManager;
        $userBdd = $userManager->findOneByUsername($username);

        if ($userBdd && password_verify($password, $userBdd->getPassword()) && $userBdd->getIsbanned()) {
            Session::addFlash('error', 'Vous êtes banni !');
        } else if ($userBdd && password_verify($password, $userBdd->getPassword())) {
            Session::setUser($userBdd);
        } else {
            echo "You are not registered yet. Please sign up";
        }
        return $this->redirectTo("index.php?ctrl=home");
    }

    public function ban()
    {

        $userId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $userManager = new UserManager;

        $ban = $userManager->update(["id" => $userId, "isBanned" => 1]);

        return $this->redirectTo("index.php?ctrl=forum&action=listcategories");
    }

    public function unban()
    {

        $userId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $userManager = new UserManager;

        $ban = $userManager->update(["id" => $userId, "isBanned" => 0]);

        return $this->redirectTo("index.php?ctrl=forum&action=listcategories");
    }
}
