<?php
namespace models;
include_once 'database.php';
class addplats extends database{
    public function InsertPlats(array $data){
        $this->SendData("INSERT INTO `plats`(`NAME`,`MENU_ID`,`Prix`) VALUES (?,?,?)",$data);
    }
}
?>
