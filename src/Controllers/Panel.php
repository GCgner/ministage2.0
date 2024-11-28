<?php

namespace Application\Controllers;

use Application\Lib\Tools;
use Application\Lib\DatabaseConnection;
use Application\Lib\Logger;
use Application\Lib\Repository;

class Panel
{
    private function getRepo(string $class):Repository
    {
        $fClass = 'Application\\Model\\'.$class.'Repository';
        
        $database = new DatabaseConnection();
        $logger = new Logger($database);
        return new $fClass($database,$logger);
    }

    public function home()
    {
        $isValid = Tools::verifyUser();
        if(!$isValid) Tools::redirect('./');

        $isAdmin = Tools::userIsAdmin();

        $user = Tools::getSession();

        require_once('templates/home_panel.php');
    }

}