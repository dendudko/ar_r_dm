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

    public function select_all(){
        $sql = 'select * from easytable;';
        $result = $this->pdo->prepare($sql);
        $result->execute();
        foreach ($result as $row){
            echo $row['id'] . $row['name'];
        }
    }


}