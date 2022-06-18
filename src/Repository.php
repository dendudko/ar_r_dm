<?php

namespace Classes;

class Repository
{
    private DataMapper $mapper;
    private $brothers = array();

    public function __construct()
    {
        $this->mapper = new DataMapper();
    }

    public function repSelectAll()
    {
        return $this->mapper->selectAll();
    }

    public function repSearchById($id)
    {
        return $this->mapper->searchById($id);
    }

    public function repSearchByName($name)
    {
        return $this->mapper->searchByName($name);
    }

    public function repSaveValue($id, $name)
    {
        return $this->mapper->saveValue($id, $name);
    }

    public function repDeleteValue($id)
    {
        return $this->mapper->deleteValue($id);
    }

}