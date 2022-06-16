<?php

namespace Classes;

use PDO;

class ActiveRecord
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=easyDB', 'root', 'password');
    }

    public function selectAll(){
        $sql = 'select * from easytable;';
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result;
    }

    public function searchById($id){
        $sql = 'select * from easytable where id="'.$id.'";';
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result;
    }

    public function searchByName($name){
        $sql = 'select * from easytable where name="'.$name.'";';
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result;
    }

    public function saveValue($id, $name){
        $sql = 'insert into easytable values ('. $id .', "'.$name.'") on duplicate key update id=id, name=name;';
        $result = $this->pdo->prepare($sql);
        $result->execute();
        $result = $this->selectAll();
        return $result;
    }

    public function deleteValue($id){
        $sql = 'delete from easytable where id="'.$id.'";';
        $result = $this->pdo->prepare($sql);
        $result->execute();
        $result = $this->selectAll();
        return $result;
    }
}