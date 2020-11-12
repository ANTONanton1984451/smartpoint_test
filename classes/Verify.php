<?php


namespace classes;


class Verify
{
    private $db;
    private $password;
    private $login;
    private $log;

    public function __construct(DB $db,string $password,string $login)
    {
        $this->db=$db;
        $this->password=$password;
        $this->login=$login;
    }

    public function auth(){
        $result=$this->getUser();
       if($result){

           if($this->verifyPassword($result['password'])){
               $_SESSION['name']=$result['name'];
               $_SESSION['id']=$result['id'];
               $this->log['user']='success';
               $this->log['name']=$result['name'];
           }else{
               $this->log['user']='no-auth';
           }
       }else{

         $this->log['user']='no-auth';

       }
       return $this->log;
    }

    private function getUser(){
        return $this->db->getRow('SELECT * FROM `users` WHERE `login`=?',[$this->login]);
    }
    private function verifyPassword(string $pass){
        if($this->password==$pass){//тут поставить мд5
            return true;
        }else{
            return false;
        }
    }

}