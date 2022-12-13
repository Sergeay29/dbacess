<?php
namespace controllers;


class users
{
    private $model;

    function __construct()
    {
        $this->model=new \models\users;

        if(isset($_GET['target'])){
            $target=$_GET['target'];
            
               
                
                    $this->$target(); 
                
            
            
        }else{
            $this->login();
        }
    }
    public function index(){
        $users = $this->model->GetAllUsers();
        $num = 1;
        $template='views/page/liste.phtml';
        include_once 'views/main.phtml';
    }
    public function CreateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["id_user"]) && isset($_POST["pwd"]) && isset($_POST["cpwd"])) {
                if (stripslashes(trim($_POST["pwd"])) == stripslashes(trim($_POST["cpwd"]))) {
                    $password = password_hash(stripslashes(trim($_POST["pwd"])), PASSWORD_DEFAULT);
                    // J'appelle la fonction InsertUser() depuis le model afin d'ajouter les données en base
                    $this->model->InsertUser([stripslashes(trim($_POST["fname"])), stripslashes(trim($_POST["lname"])), stripslashes(trim($_POST["id_user"])), $password]); 
                    header("location:index.php?goto=user&target=login");
                }

            }
        }
        // J'appelle la fonction GetAllUsers() depuis le model qui me permet de recuperer tous les utilisateurs en base
       
        // Chargement du formulaire
        $template ='views/page/formulaire.phtml';
        include_once 'views/main.phtml';
    }
    public function UserDelete()
    {
        if (isset($_GET['id'])) {
            // J'appelle DeleteUser() depuis le model, qui me permet de supprimer un utilisateur en fonction de son id 
            $this->model->DeleteUser(intval($_GET['id']));
            header("location: index.php");
            exit();
        } else {
            header("location: index.php");
            exit();
        }
    }

   public function Update()
    {
        $this->model->GetUserById(intval($_GET['id']));
    }

     public function recherche()
    {
        $users = $this->model->Recherches([$_POST['motcle']]);
        $num = 1;
        include_once 'views/formulaire.phtml';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["id_user"]) && isset($_POST["pwd"])) {
                $user = $this->model->GetUserByLogin($_POST["id_user"]);
                if ($user) {
                    if (password_verify($_POST["pwd"], $user['Mdp'])){
                        header("location:index.php?goto=reservation");
                        exit();
                    }
                }
            }
        }
        $template ='views/page/connexion.phtml';
        include_once 'views/main.phtml';
    }
}
