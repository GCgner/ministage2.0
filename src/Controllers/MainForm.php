<?php

namespace Application\Controllers;

use Application\Lib\Tools;
use Application\Lib\DatabaseConnection;
use Application\Lib\Logger;
use Application\Model\SlotRepository;
use Application\Model\RequestRepository;

class MainForm {

    private function getSlotRepo()
    {
        $database = new DatabaseConnection;
        $logger = new Logger($database);
        return new SlotRepository($database,$logger);
    }

    private function getRequestRepo()
    {
        $database = new DatabaseConnection;
        $logger = new Logger($database);
        return new RequestRepository($database,$logger);
    }

    public function execute()
    {
        $requestRepository = $this->getSlotRepo();

        $slots = $requestRepository->getSlots();

        require('templates/main_form.php');
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