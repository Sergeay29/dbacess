<?php
namespace controllers;
class addplats 
{
    private $modelplats;

    function __construct()
    {
        $this->modelplats=new \models\addplats;

        if(isset($_GET['target'])){
            $target=$_GET['target'];
            
                if(!$this->$target()){
                    echo '404 - Not found';
                }else{
                    $this->$target(); 
                }
            
            
        }else{
            $this->formulairePlats();
        }
    } 
    public function formulairePlats(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["menu"]) && isset($_POST["pname"]) && isset($_POST["prix"])) {
                
                $this->modelplats->InsertPlats([$_POST["menu"],$_POST["pname"],$_POST["prix"]]);
               
                        header("location: index.php?goto=reservation");
                        exit();
                
            }
        }
        $template ='views/page/addplats.phtml';
        include_once 'views/main.phtml';
    }
}