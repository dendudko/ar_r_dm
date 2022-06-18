<?php

namespace Controllers;

use Classes\ActiveRecord;

class Controller extends BaseClass
{
    public function main()
    {
        $ar = new ActiveRecord();
        
        if ($this->uri == '/') {
            header('Location: /active_record?');
        }

        if (strpos($this->uri, '/active_record') === 0) {
            $this->showMenu('active_record');
            if (strpos($this->uri, '/active_record?select_all') === 0) {
                $results = $ar->selectAll();
                $text = 'Все записи';
            } else if (strpos($this->uri, '/active_record?search_id') === 0) {
                $id = $_GET['search_id'];
                $results = $ar->searchById($id);
                $text = 'Поиск по ID (id = ' . $id . ')';
            } else if (strpos($this->uri, '/active_record?search_name') === 0) {
                $name = $_GET['search_name'];
                $results = $ar->searchByName($name);
                $text = 'Поиск по имени (name = ' . $name . ')';
            } else if (strpos($this->uri, '/active_record?insert') === 0) {
                $id = $_GET['insert_id'];
                $name = $_GET['insert_name'];
                $results = $ar->saveValue($id, $name);
                $text = 'Добавление записи (id = ' . $id . ', name = ' . $name . ')';
            } else if (strpos($this->uri, '/active_record?delete') === 0) {
                $id = $_GET['delete_id'];
                $results = $ar->deleteValue($id);
                $text = 'Удаление записи (id = ' . $id . ')';
            }
            if ($results && $text){
                $this->lazyTwig($this->twig, $results, $text);
            }
        } else if (strpos($this->uri, '/repository_data_mapper?') === 0) {
            $controller2 = new Controller_2();
            $controller2->main();
        }
    }
}