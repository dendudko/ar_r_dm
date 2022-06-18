<?php

namespace Classes;

use PDO;

class ActiveRecord
{
    private PDO $pdo;
    private int $id;
    private string $name;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=easyDB', 'root', 'password');
    }

    private function returnBrothers($result){
        $brothers = array();
        foreach ($result as $res){
            $brat = new ActiveRecord();
            $brat->setId($res['id']);
            $brat->setName($res['name']);
            $brothers[] = $brat;
        }
        return $brothers;
    }

    public function selectAll()
    {
        $sql = 'select * from easytable;';
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $this->returnBrothers($result);
    }

    public function searchById($id){
        $sql = "select * from easytable where id=$id;";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $this->returnBrothers($result);
    }

    public function searchByName($name){
        $sql = "select * from easytable where name='$name';";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $this->returnBrothers($result);
    }

    public function saveValue($id, $name){
        $sql = "insert into easytable values ($id, '$name') on duplicate key update id=id, name=name;";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $this->selectAll();
    }

    public function deleteValue($id){
        $sql = "delete from easytable where id=$id;";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $this->selectAll();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}