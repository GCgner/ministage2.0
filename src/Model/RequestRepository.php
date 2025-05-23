<?php 

Namespace Application\Model;

use Application\Lib\Tools;
use Application\Lib\Repository;
use Application\Lib\Classes\Request;

class RequestRepository extends Repository
{
    const TABLE_NAME = 'requests';
    const CLASS_NAME = 'Request';
    const ID_NAME = 'request_id';
    const ATTRIBUTES_NAME = 'request_id,firstname,lastname,class,birthday,parent_firstname,parent_lastname,address,phone,email,main_teacher,accepted,slot_id';
    const ATTRIBUTES_PREPARE = '?,?,?,?,?,?,?,?,?,?,?,?';



    public function getRequests():array
    {
        try {
            $data = $this->getData();
            
            $name = 'Select all Requests';
            $log = 'Selection of all the data in Requests table';
            $action = 'SELECT';
            
            $this->newLog($name,$log,$action);

            return $data;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }
    
    public function getRequestById(int $requestId):Request
    {
        try {
            $data = $this->getDataById($requestId);
            
            $name = 'Select a(n) Request';
            $log = 'Selection of the data in Requests table with an request_id equal to $requestId';
            $action = 'SELECT';
            
            $this->newLog($name,$log,$action);

            return $data;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function getRequestsBySlotId(int $slotId) {
        try {
            $dataStatement = $this->database->getConnection()->query('SELECT * FROM '.static::TABLE_NAME.' WHERE slot_id = '.$slotId);
            
            $data = $this->dataInArray($dataStatement);
            
            $name = 'Select a(n) Request';
            $log = 'Selection of the data in Requests table with an slot_id equal to '.$slotId;
            $action = 'SELECT';
            
            $this->newLog($name,$log,$action);

            return $data;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function getRequestsByUserId(int $userId) {
        try {
            $dataStatement = $this->database->getConnection()->query('SELECT requests.* FROM '.static::TABLE_NAME.' INNER JOIN slots ON requests.slot_id = slots.slot_id WHERE slots.user_id = '.$userId);
            
            $data = $this->dataInArray($dataStatement);
            
            $name = 'Select a(n) Request';
            $log = 'Selection of the data in Requests table with an user_id equal to '.$userId;
            $action = 'SELECT';
            
            $this->newLog($name,$log,$action);

            return $data;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function insertRequest(array $data):int|string
    {
        try{
            $newId = $this->insertData($data);
            
            $name = 'Insert a(n) Request';
            $log = 'Insert a new Request in the Requests table, an id_Request given for this new entry is '.$newId;
            $action = 'INSERT';
            
            $this->newLog($name,$log,$action);

            return $newId;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function updateRequest(int $requestId,array $data):bool|string
    {
        try{
            $this->updateData($requestId,$data);
            
            $name = 'Update a(n) Request';
            $log = 'Update the data of a(n)Request in the Requests table with an id_Request equal to '.$requestId;
            $action = 'UPDATE';
            
            $this->newLog($name,$log,$action);

            return true;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function updateAccepted(int $requestId,int $accepted):bool|string
    {
        try{
            $updateStatement = $this->database->getConnection()->prepare('UPDATE '.static::TABLE_NAME.' SET accepted = ? WHERE request_id = '.$requestId);
            $updateStatement->execute([$accepted]);

            return true;
        } catch (\Exception $e) {
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function deleteRequest(int $requestId):bool
    {
        try{
            $this->deleteData($requestId);
            
            $name = 'Delete a(n) Request';
            $log = 'Delete the entry in Requests table with the id_Request equal to '.$requestId;
            $action = 'DELETE';
            
            $this->newLog($name,$log,$action);

            return true;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function deleteMultipleRequest(array $data):bool
    {
        try{
            $this->deleteMultipleData($data);
            
            $c = count($data);

            $ids = $this->arrayInString($data);

            $name = 'Delete '.$c.' Request';
            $log = 'Delete '.$c.' entry in Requests table with the id_Request in ('.$ids.')';
            $action = 'DELETE';
            
            $this->newLog($name,$log,$action);

            return true;
        }
        catch(\Exception $e){
            Tools::debugVar('Erreur :'.$e->getMessage());
            return 'Erreur :'.$e->getMessage();
        }
    }

}