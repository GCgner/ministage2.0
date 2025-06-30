<?php


namespace Application\Controllers;

use Application\Lib\Tools;
use Application\Lib\Logger;
use Application\Lib\DatabaseConnection;
use Application\Model\RequestRepository;
use Application\Model\SlotRepository;

class Request {

    private function getRepo():RequestRepository {
        $db = new DatabaseConnection();
        $logger = new Logger($db);
        return new RequestRepository($db,$logger);
    }

    private function getSlotRepo():SlotRepository {
        $db = new DatabaseConnection();
        $logger = new Logger($db);
        return new SlotRepository($db,$logger);
    }


    
    private function verify(array $input):array|string {
        if(!isset($input['firstname']) || empty($input['firstname'])) return('Le prénom fourni n\'est pas valide !');
        $firstname = \htmlspecialchars($input['firstname']);

        if(!isset($input['lastname']) || empty($input['lastname'])) return('Le nom de famille fourni n\'est pas valide !');
        $lastname = \htmlspecialchars($input['lastname']);

        if(!isset($input['class']) || empty($input['class'])) return('La classe fournie n\'est pas valide !');
        $class = \htmlspecialchars($input['class']);

        if(!isset($input['birthday'])) return('La date de naissance fournie n\'est pas valide !');
        $date = time() - 315360000;
        $minDate = (new \DateTimeImmutable())->setTimestamp($date);
        $birthday = new \DateTimeImmutable($input['birthday']);
        if($minDate < $birthday) return('Le date de naissance fournie n\'est pas valide !');
        $birthday = $input['birthday'];

        if(!isset($input['parent_firstname']) || empty($input['parent_firstname'])) return('Le prénom du parent fourni n\'est pas valide !');
        $firstnameParent = \htmlspecialchars($input['parent_firstname']);

        if(!isset($input['parent_lastname']) || empty($input['parent_lastname'])) return('Le nom de famille du parent fourni n\'est pas valide !');
        $lastnameParent = \htmlspecialchars($input['parent_lastname']);

        if(!isset($input['address']) || empty($input['address'])) return('L\'addresse fournie n\'est pas valide !');
        $address = \htmlspecialchars($input['address']);

        if(!isset($input['phone']) || empty($input['phone'])) return('Le numéro de téléphone fourni n\'est pas valide !');
        $phone = \htmlspecialchars($input['phone']);

        if(!isset($input['email']) || !filter_var($input['email'],FILTER_VALIDATE_EMAIL)) return('L\'adresse mail fourni n\'est pas valide !');
        $email = \htmlspecialchars($input['email']);

        if(!isset($input['main_teacher']) || empty($input['main_teacher'])) return('Le professeur(e) principal(e) indiqué(e) n\'est pas valide !');
        $mainTeacher = \htmlspecialchars($input['main_teacher']);

        if(!isset($input['slot'])) return('Le stage sélectionné n\'est pas valide !');
        $slotId = intval($input['slot']);
        if($slotId < 1) return('Le stage sélectionné n\'est pas valide !');
        $slotRepository = $this->getSlotRepo();
        $slot = $slotRepository->getSlotById($slotId);
        if(!$slot) return('Le stage sélectionné n\'est pas valide !');

        return [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'class' => $class,
            'birthday' => $birthday,
            'parent_firstname' => $firstnameParent,
            'parent_lastname' => $lastnameParent,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'main_teacher' => $mainTeacher,
            'accepted' => 0,
            'slot_id' => $slotId,
        ];
    }

    public function requestPanel() {
        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');

        $isAdmin = Tools::userIsAdmin();

        $user = Tools::getSession();

        $err = $_SESSION['err'];
        $success = $_SESSION['success'];

        $requestRepository = $this->getRepo();

        $requests = $isAdmin ? $requestRepository->getRequests() : $requestRepository->getRequestsByUserId($user->getUserId());

        require_once('templates/request_panel.php');
    }

    public function createRequest() {

        // ✅ SUPPRIMÉ LA VÉRIF POUR UTILISATEUR CONNECTÉ
        $_SESSION['err'] = null;
        $_SESSION['success'] = null;

        try {
            $input = $_POST;

            // Validation et nettoyage des données
            $verifiedInput = $this->verify($input);
            if (is_string($verifiedInput)) {
                throw new \Exception($verifiedInput);
            }

            // Insertion de la demande
            $requestRepository = $this->getRepo();
            $newId = $requestRepository->insertRequest($verifiedInput);

            if (!is_int($newId)) {
                throw new \Exception("Une erreur est survenue lors de l'enregistrement de la demande.");
            }

            $_SESSION['success'] = 'Demande enregistrée avec succès.';
        } catch (\Exception $e) {
            $_SESSION['err'] = $e->getMessage();
        }

        // ✅ Redirige vers le formulaire principal
        Tools::redirect('/GitHub/ministage2.0/');

        }


    public function validRequest($id) {

        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');

        $isAdmin = Tools::userIsAdmin();

        $user = Tools::getSession();

        $input = $_GET;

        $err = '';

        try {

            // if(!isset($input['t'])) throw new \Exception('La requête envoyée est invalide !');
        
            $requestId = intval($id);
            
            if($requestId < 1) throw new \Exception('La requête envoyée est invalide !');
            
            $requestRepository = $this->getRepo();
            $request = $requestRepository->getRequestById($requestId);

            if(!$request) throw new \Exception('La requête envoyée est invalide !');

            $slotRepository = $this->getSlotRepo();
            $slot = $slotRepository->getSlotById($request->getSlotId());

            if(!$slot || $slot->getUserId() != $user->getUserId()) throw new \Exception('La requête envoyée est invalide !');
            if($slot->getMaxPlaces() <= $slot->getCountPlaces()) throw new \Exception('Le stage est demandé est déjà complet !');
            

            $accepted = $request->getAccepted() ? 0 : 1;

            $requestRepository->updateAccepted($requestId,$accepted);

            $countPlaces = $accepted == 0 ? $slot->getCountPlaces() - 1 : $slot->getCountPlaces() + 1;

            $slotRepository->updateCountPlaces($slot->getSlotId(),$countPlaces);

        } catch(\Exception $e) {
            $err = $e->getMessage();
        }

        $success = true;

        if($err != '') $success = false;

        $_SESSION['err'] = $err;
        $_SESSION['success'] = $success;

        Tools::redirect('/Github/ministage2.0/requests');
    }
    public function createForm() {
        Tools::verifyUser() || Tools::redirect('./');

        // Récupérer les créneaux de stage
        $slotRepo = $this->getSlotRepo();
        $slots = $slotRepo->getSlots(); // Assurez-vous que cette méthode existe et retourne tous les slots

        // Messages flash
        $err = $_SESSION['err'] ?? '';
        $success = $_SESSION['success'] ?? null;

        // Afficher le formulaire avec les données des stages
        require_once('templates/request_menu.php');
    }

    public function createRequestNew() {

        // SUPPRIMÉ LA VÉRIF POUR UTILISATEUR CONNECTÉ
        $_SESSION['err'] = null;
        $_SESSION['success'] = null;

        try {
            $input = $_POST;

            // Validation et nettoyage des données
            $verifiedInput = $this->verify($input);
            if (is_string($verifiedInput)) {
                throw new \Exception($verifiedInput);
            }

            // Insertion de la demande
            $requestRepository = $this->getRepo();
            $newId = $requestRepository->insertRequest($verifiedInput);

            if (!is_int($newId)) {
                throw new \Exception("Une erreur est survenue lors de l'enregistrement de la demande.");
            }

            $_SESSION['success'] = 'Demande enregistrée avec succès.';
        } catch (\Exception $e) {
            $_SESSION['err'] = $e->getMessage();
        }

        // Redirige vers le formulaire principal
        Tools::redirect('/GitHub/ministage2.0/requests');

    }



}