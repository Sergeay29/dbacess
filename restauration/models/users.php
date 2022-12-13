<?php
namespace models;
include_once 'database.php';

class users extends database{
public function InsertUser(array $data){
    $this->SendData("INSERT INTO users(Nom, Prenoms, Identifiant, Mdp) VALUES (?,?,?,?)",$data);
}
public function UpdateUser(array $data){
    $this->SendData("UPDATE users SET Nom=?,Prenoms=?,Identifiant=?,Mdp=? WHERE Id=?",$data);
}
public function DeleteUser(int $id){
    $this->SendData("DELETE FROM users WHERE Id=?",[$id]);
}
public function GetAllUsers(): array{
    return $this->GetManyData("SELECT Id,Nom, Prenoms, Identifiant FROM users",NULL);
}
public function GetUserById(int $id){
    return $this->GetOneData("SELECT Id,Nom, Prenoms, Identifiant FROM users WHERE Id=?",[$id]);
}
public function Recherches(array $data){
   return $this->GetManyData("SELECT Id, Nom, Prenoms, Identifiant FROM users WHERE Nom=? or Prenoms=? or Identifiant=?" , $data);
}
public function GetUserByLogin(string $login){
    return $this->GetOneData("SELECT Id, Nom, Prenoms, Identifiant, Mdp FROM users WHERE Identifiant=?",[$login]);
}
}