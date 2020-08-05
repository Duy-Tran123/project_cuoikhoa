<?php
require_once 'models/Model.php';
class Order extends Model{
    public $user_id;
    public $fullname;
    public $address;
    public $mobile;
    public $email;
    public $note;
    public $price_total;
    public $payment_status;
    public $created_at;
    public $updated_at;

    public function getAll(){
        $obj_select = $this->connection->prepare("SELECT * FROM orders ");
        $obj_select->execute();
        $orders = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }
}