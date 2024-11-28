<?php

namespace Application\Lib;

use Application\Lib\Tools;
use \PDO;

class DatabaseConnection {

    public ?PDO $database=null;

    public function getConnection():PDO {

        $host = 'localhost';
        $db = 'ministage';
        $login = 'root';
        $password = '';

        if($this->database === null){
            $this->database = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8',$login,$password);
            $this->database->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        }

        return $this->database;

    }

}