<?php

namespace Application\Controllers;

use Application\Lib\Tools;
use Application\Lib\DatabaseConnection;
use Application\Lib\Logger;
use Application\Model\UserRepository;

class Login
{

    private function getRepo()
    {
        $database = new DatabaseConnection;
        $logger = new Logger($database);
        return new UserRepository($database,$logger);
    }

    public function execute()
    {
        require('templates/login.php');
    }

    public function login() 
    {
        $input = $_POST;

        if(!isset($input['email']) || !filter_var($input['email'], FILTER_VALIDATE_EMAIL) || !isset($input['password']) || empty($input['password'])) {
            $_SESSION['err'] = "Les identifiants ne correspondent à aucun compte existant";
            Tools::redirect('/login');
            return;
        }

        $userRepository = $this->getRepo();
        $success = $userRepository->connectUser($input);

        if($success === true)
        {
            $link = './home';
            if(isset($_SESSION['redirect'])) {
                $link = $_SESSION['redirect'];
                unset($_SESSION['redirect']);
            }
            Tools::redirect($link);
        }
        else
        {
            $_SESSION['err'] = $success; // Stocke le message d'erreur retourné par `connectUser`
            Tools::redirect('/login');
        }
    }

    public function logout()
    {
        $this->getRepo()->disconnectUser();
    }

}