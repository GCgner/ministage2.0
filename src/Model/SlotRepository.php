<?php

Namespace Application\Model;

use Application\Lib\Tools;
use Application\Lib\Repository;
use Application\Lib\Classes\Slot;

class SlotRepository extends Repository
{
    const TABLE_NAME = 'slots';
    const CLASS_NAME = 'Slot';
    const ID_NAME = 'slot_id';
    const ATTRIBUTES_NAME = 'slot_id,date_start,date_end,sector,max_places,count_places,user_id';
    const ATTRIBUTES_PREPARE = '?,?,?,?,?,?,?';

    public function getSlots():array
    {
        try {
            $data = $this->getData();
            
            $name = 'Select all Slots';
            $log = 'Selection of all the data in Slots table';
            $action = 'SELECT';
            
            $this->newLog($name,$log,$action);

            return $data;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }
    
    public function getSlotById(int $slotId):Slot
    {
        try {
            $data = $this->getDataById($slotId);
            
            $name = 'Select a(n) Slot';
            $log = 'Selection of the data in Slots table with an id_Slot equal to '.$slotId;
            $action = 'SELECT';
            
            $this->newLog($name,$log,$action);

            return $data;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function getSlotsByUserId(int $userId):array|string {
        try {
            $dataStatement = $this->database->getConnection()->query('SELECT * FROM '.static::TABLE_NAME.' WHERE user_id = '.$userId);
            
            $data = $this->dataInArray($dataStatement);
            
            $name = 'Select a(n) Slot';
            $log = 'Selection of the data in Slots table with an user_id equal to '.$userId;
            $action = 'SELECT';
            
            $this->newLog($name,$log,$action);

            return $data;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function insertSlot(array $data):int|string
    {
        try{
            $newId = $this->insertData($data);
            
            $name = 'Insert a(n) Slot';
            $log = 'Insert a new Slot in the Slots table, an id_Slot given for this new entry is '.$newId;
            $action = 'INSERT';
            
            $this->newLog($name,$log,$action);

            return $newId;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function updateSlot(int $slotId,array $data):bool|string
    {
        try{
            $this->updateData($slotId,$data);
            
            $name = 'Update a(n) Slot';
            $log = 'Update the data of a(n)Slot in the Slots table with an id_Slot equal to '.$slotId;
            $action = 'UPDATE';
            
            $this->newLog($name,$log,$action);

            return true;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function updateCountPlaces(int $slotId,int $countPlaces):bool|string
    {
        try {
            $updateStatement = $this->database->getConnection()->prepare('UPDATE '.static::TABLE_NAME.' SET count_places = ? WHERE slot_id = '.$slotId);
            $updateStatement->execute([$countPlaces]);

            return true;
        } catch(\Exception $e) {
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function deleteSlot(int $slotId):bool
    {
        try{
            $this->deleteData($slotId);
            
            $name = 'Delete a(n) Slot';
            $log = 'Delete the entry in Slots table with the id_Slot equal to '.$slotId;
            $action = 'DELETE';
            
            $this->newLog($name,$log,$action);

            return true;
        }
        catch(\Exception $e){
            return 'Erreur :'.$e->getMessage();
        }
    }

    public function deleteMultipleSlot(array $data):bool
    {
        try{
            $this->deleteMultipleData($data);
            
            $c = count($data);

            $ids = $this->arrayInString($data);

            $name = 'Delete '.$c.' Slot';
            $log = 'Delete '.$c.' entry in Slots table with the id_Slot in ('.$ids.')';
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