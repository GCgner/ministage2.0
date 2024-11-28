<?php

namespace Application\Controllers;

use Application\Lib\Tools;
use Application\Lib\DatabaseConnection;
use Application\Lib\Logger;
use Application\Model\SlotRepository;

class Slot
{
    private function getRepo():SlotRepository
    {
        $db = new DatabaseConnection();
        $logger = new Logger($db);
        return new SlotRepository($db,$logger);
    }

    private function verify(array $input,int $userId):array|string {

        $today = new \DateTimeImmutable("now");

        if(!isset($input["date_start"])) return('La date de début fournie n\'est pas valide !');
        $dateStart = new \DateTimeImmutable($input["date_start"]);
        if($today >= $dateStart) return('La date de début fournie n\'est pas valide !');

        if(!isset($input["date_end"])) return('La date de fin fournie n\'est pas valide !');
        $dateEnd = new \DateTimeImmutable($input["date_end"]);
        if($dateStart >= $dateEnd) return('La date de fin fournie n\'est pas valide !');
        
        $dateStart = $input["date_start"];
        $dateEnd = $input["date_end"];

        if(!isset($input['sector']) || empty($input['sector'])) return('La filière fournie n\'est pas valide !');
        $sector = $input['sector'];

        $maxPlaces = intval($input['max_places']);
        if(!isset($input['max_places']) || $maxPlaces < 1) return('Le nombre de places fourni n\'est pas valide !');

        if($userId <= 1) return('L\'utilisateur n\'a pas les permissions de réaliser cette action');

        return [
            "date_start" => $dateStart,
            "date_end" => $dateEnd,
            "sector" => $sector,
            "max_places" => $maxPlaces,
            "count_places" => 0,
            "user_id" => $userId
        ];
    }

    public function slotPanel() 
    {
        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');

        $user = Tools::getSession();

        $slotRepository = $this->getRepo();

        $isAdmin = Tools::userIsAdmin();

        $err = $_SESSION['err'];
        $success = $_SESSION['success'];

        $slots = $isAdmin ? $slotRepository->getSlots() : $slotRepository->getSlotsByUserId($user->getUserId());

        require_once('templates/slot_panel.php');
    }

    public function createSlotMenu() {
        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');

        $isAdmin = Tools::userIsAdmin();

        $user = Tools::getSession();

        require_once('templates/slot_menu.php');
    }

    public function createSlot() {
        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');

        $isAdmin = Tools::userIsAdmin();

        $user = Tools::getSession();

        $input = $_POST;

        $input = $this->verify($input,$user->getUserId());

        $err = '';

        try {
            $exc = false;

            if(is_string($input)) throw new \Exception($input);

            $slotRepository = $this->getRepo();

            $slotRepository->insertSlot($input);
        } catch (\Exception $e) {
            $err = $e->getMessage();
        }

        $success = true;

        if($err != '') $success = false;

        require_once('templates/slot_menu.php');
    }

    public function deleteSlot() {
        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');

        $isAdmin = Tools::userIsAdmin();

        $user = Tools::getSession();

        if(!isset($_POST['slotId'])) Tools::redirect('./');

        $err = '';

        try {
            $slotId = intval($_POST['slotId']);

            if($slotId < 1) throw new \Exception("La valeur indiqué n'est pas valide !");
    
            $slotRepository = $this->getRepo();
    
            $slotRem = $slotRepository->getSlotById($slotId);
    
            if(!$slotRem) throw new \Exception("Le stage que vous avez sélectionné n'existe pas");
    
            if(!$isAdmin) {
                if($slotRem->getUserId() != $user->getUserId()) throw new \Exception('Vous n\'avez pas les permissions nécessaires pour supprimer ce stage !');
            }

            $slotRepository->deleteSlot($slotId);
        }
        catch(\Exception $e) {
            $err = $e->getMessage();
        }

        $success = true;

        if($err != '') $success = false;

        $_SESSION['err'] = $err;
        $_SESSION['success'] = $success;

        Tools::redirect('slots');
    }
}