<?php
require_once 'models/Model.php';
class Contact extends Model{
    public $username;
    public $email;
    public $note;

        public function insert() {
            $sql_insert = "INSERT INTO 
client (`username`, `email`,`note`) VALUES (:username,:email,:note)";
            $obj_insert = $this->connection->prepare($sql_insert);
            $arr_insert = [
                ':username' => $this->username,
                ':email' => $this->email,
                ':note' => $this->note,
            ];
            $is_insert = $obj_insert->execute($arr_insert);
            return $is_insert;
        }
}