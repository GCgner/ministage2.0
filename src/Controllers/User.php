<?php

namespace Application\Controllers;

use Application\Lib\Tools;
use Application\Lib\Logger;
use Application\Lib\DatabaseConnection;
use Application\Model\UserRepository;

class User {
    private function getRepo():UserRepository {
        $db = new DatabaseConnection();
        $logger = new Logger($db);
        return new UserRepository($db,$logger);
    }

    private function verify(array $input):array|string {
        if(!isset($input['firstname']) || empty($input['firstname'])) return('Le prénom fourni n\'est pas valide !');
        $firstname = \htmlspecialchars($input['firstname']);

        if(!isset($input['lastname']) || empty($input['lastname'])) return('Le nom fourni n\'est pas valide !');
        $lastname = \htmlspecialchars($input['lastname']);

        if(!isset($input['email']) || !filter_var($input['email'],FILTER_VALIDATE_EMAIL)) return('L\'adresse mail fourni n\'est pas valide !');
        $email = \htmlspecialchars($input['email']);

        // $userRepository = $this->getRepo();

        // if(!empty($userRepository->getUserByEmail($email))) return('L\'adresse mail fourni est déjà utilisé !');

        if(!isset($input['speciality']) || empty($input['speciality'])) return('Le nom fourni n\'est pas valide !');
        $speciality = \htmlspecialchars($input['speciality']);

        $noHashPassword = Tools::genPasswd();
        $password = password_hash($noHashPassword,PASSWORD_BCRYPT);

        return [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'speciality' => $speciality,
            'password' => $password,
            'clearPassword' => $noHashPassword
        ];
    }

    public function userPanel() 
    {
        $isAdmin = Tools::userIsAdmin();
        if(!$isAdmin) Tools::redirect('./');

        $user = Tools::getSession();

        $err = $_SESSION['err'];
        $success = $_SESSION['success'];

        $userRepository = $this->getRepo('User');
        $users = $userRepository->getUsers();

        require_once('templates/user_panel.php');
    }

    public function createUserMenu() {
        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');

        $isAdmin = Tools::userIsAdmin();
        if(!$isAdmin) Tools::redirect('./');

        $user = Tools::getSession();

        require_once('templates/user_menu.php');
    }

    public function createUser() {

        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');

        $isAdmin = Tools::userIsAdmin();
        if(!$isAdmin) Tools::redirect('./');

        $user = Tools::getSession();

        $input = $_POST;

        $input = $this->verify($input);

        $err='';

        try {

            if(is_string($input)) throw new \Exception($input);

            $userRepository = $this->getRepo();

            $clearPassword = array_pop($input);

            $userRepository->registerUser($input);

            //throw new \Exception("Une erreur est survenue durant l'envoie du mail, voici le mot de passe del'utilisateur : ".$clearPassword);
        
            // try{
                // mail(
                    // $input['email'],
                    // "Création du compte ministage",
                    // "Votre compte ministage vient d'être créé.\n Votre adresse mail sert d'identifiant, voici votre mot de passe : ".$clearPassword
                // );
            // }
            // catch(\Exception $e) {
            // }


        } catch(\Exception $e) {
            $err = $e->getMessage();
        }


        $success = true;

        if($err != '') $success = false;

        require_once('templates/user_menu.php');
    }

    public function deleteUser() {
        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');


        $isAdmin = Tools::userIsAdmin();
        if(!$isAdmin) Tools::redirect('./');

        $user = Tools::getSession();

        if(!isset($_POST['userId'])) Tools::redirect('./');

        $err = '';

        try {
            try {
                $userId = intval($_POST['userId']);
            }
            catch(\Exception $e) {
                throw new \Exception("La valeur indiqué n'est pas valide");
            }

            if($userId <= 2) throw new \Exception("Cet utilisateur ne peut être supprimé");
        
            $userRepository = $this->getRepo();

            $userRem = $userRepository->getUserById($userId);

            if(!$userRem) throw new \Exception("L'utilisateur que vous avez sélectionné n'existe pas");
        
            $userRepository->deleteUser($userId);
        }
        catch(\Exception $e) {
            $err = $e->getMessage();
        }
    
        $success = true;

        if($err != '') $success = false;

        $_SESSION['err'] = $err;
        $_SESSION['success'] = $success;

        Tools::redirect('/Github/ministage2.0/users');

    }

    public function getUserId(): int
    {
        return $this->user_id;  // ou comment est stocké l'id dans ta classe
    }

}