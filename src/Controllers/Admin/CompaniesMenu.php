<?php

namespace Application\Controllers\Admin;

use Application\Lib\Tools;
use Application\Lib\DatabaseConnection;
use Application\Lib\Logger;
use Application\Model\CompanieRepository;

class CompaniesMenu{

    private function getRepo()
    {
        $database = new DatabaseConnection();
        $logger = new Logger($database);

        return new CompanieRepository($databse,$logger);
    }

}