<?php
namespace controllers;
class reservation 
{
    function __construct(){
       
        // $this->modelreservation = new \models\reservation();

        if(isset($_GET['target'])){
            $target=$_GET['target'];
            
                if(!$this->$target()){
                    echo '404 - Not found';
                }else{
                    $this->$target(); 
                }
            
            
        }else{
            $this->Reserv();
        }
    }
    public function Reserv(){

        $template ='views/page/reservation.phtml';
        include_once 'views/main.phtml';
    }
}