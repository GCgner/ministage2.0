<?php 

namespace Application\Controllers;

use Application\Lib\Tools;
use Application\Lib\DatabaseConnection;
use Application\Lib\Logger;
use Application\Model\UserRepository;

class Signup 
{

    public function execute()
    {
        require_once('templates/signup.php');
    }

    public function signup()
    {
        $input = $_POST;

        $database = new DatabaseConnection();
        $logger = new Logger($database);
        $userRepository = new UserRepository($database, $logger);

        function verify($input,$userRepository) {
            if(!isset($input['firstname']) || empty($input['firstname'])) return('Le prénom fourni n\'est pas valide !');
            $firstname = \htmlspecialchars($input['firstname']);

            if(!isset($input['lastname']) || empty($input['lastname'])) return('Le nom fourni n\'est pas valide !');
            $lastname = \htmlspecialchars($input['lastname']);

            if(!isset($input['email']) || !filter_var($input['email'],FILTER_VALIDATE_EMAIL)) return('L\'adresse mail fourni n\'est pas valide !');
            $email = \htmlspecialchars($input['email']);

            if(!empty($userRepository->getUserByEmail($email))) return('L\'adresse mail fourni est déjà utilisé !');

            if(!isset($input['password']) || empty($input['password'])) return('Le mot de passe fourni n\'est pas valide !');

            if(!isset($input['confirm']) || $input['password'] !== $input['confirm']) return('La confirmation ne correspond pas au mot de passe indiqué !');

            $password = password_hash($input['password'],PASSWORD_ARGON2I);

            if(!isset($input['phone']) || empty($input['phone'])) return('Le numéro de téléphone fourni n\'est pas valide !');
            $phone = \htmlspecialchars($input['phone']);

            if(!isset($input['birthday']) || !Tools::verifyDateInput($input['birthday'])) return('La date de naissance fourni n\'est pas valide !');
            $birthday = $input['birthday'];

            if(!isset($input['address']) || empty($input['address'])) return('L\'adresse rensiegné n\'est pas valide !');
            $address = $input['address'];

            if(!isset($input['postal']) || empty($input['postal'])) return('Le code postal renseigné n\'est pas valide !');
            $postal = \htmlspecialchars($input['postal']);

            if(!isset($input['country']) || empty($input['country'])) return('Le pays renseigné n\'est pas valide !');
            $country = \htmlspecialchars($input['country']);


            $values = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $password,
                'phone' => $phone,
                'birthday' => $birthday,
                'address' => $address,
                'postal_code' => $postal,
                'country' => $country
            ];

            return $values;
        }

        $values = verify($input,$userRepository);

        if(is_array($values))
        {
            try{
                $userRepository->registerUser($values);
                Tools::redirect('login');
            }
            catch(\Exception $e)
            {
                $err = $e->getMessage();
            }
        }
        else
        {
            $err = $values;
        }

        require_once('templates/signup.php');
    }

}