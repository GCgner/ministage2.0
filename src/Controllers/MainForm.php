<?php

namespace Application\Controllers;

use Application\Lib\Tools;
use Application\Lib\DatabaseConnection;
use Application\Lib\Logger;
use Application\Model\SlotRepository;
use Application\Model\RequestRepository;

class MainForm {
    private $db;
    private $logger;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->logger = new Logger($this->db);
    }

    private function getSlotRepo(): SlotRepository
    {
        return new SlotRepository($this->db, $this->logger);

    }

    private function getRequestRepo(): RequestRepository
    {
        return new RequestRepository($this->db, $this->logger);
    }

    public function execute()
    {

        $slotRepository = $this->getSlotRepo();
        $slots = $slotRepository->getSlots();

        require('templates/main_form.php');

        // 💡 Effacer les messages APRES affichage
        unset($_SESSION['err'], $_SESSION['success']);
    }

    public function request()
    {
        $input = $_POST;

        if(!isset($input['email']) ||  !filter_var($input['email'],FILTER_VALIDATE_EMAIL) || !isset($input['password']) || empty($input['password']))
        {
            echo 'test';
            throw new \RuntimeException('Les identifiants ne correspondent à aucun compte existant');
        }
    }

}