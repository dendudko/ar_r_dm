<?php

namespace Controllers;

use Classes\Repository;

class Controller_2 extends BaseClass
{
    public function main()
    {
        $this->showMenu('repository_data_mapper');
        $repository = new Repository();
        if (strpos($this->uri, '/repository_data_mapper?select_all') === 0) {
            $results = $repository->repSelectAll();
            $text = 'Все записи';
        } else if (strpos($this->uri, '/repository_data_mapper?search_id') === 0) {
            $id = $_GET['search_id'];
            $results = $repository->repSearchById($id);
            $text = 'Поиск по ID (id = ' . $id . ')';
        } else if (strpos($this->uri, '/repository_data_mapper?search_name') === 0) {
            $name = $_GET['search_name'];
            $results = $repository->repSearchByName($name);
            $text = 'Поиск по имени (name = ' . $name . ')';
        } else if (strpos($this->uri, '/repository_data_mapper?insert') === 0) {
            $id = $_GET['insert_id'];
            $name = $_GET['insert_name'];
            $results = $repository->repSaveValue($id, $name);
            $text = 'Добавление записи (id = ' . $id . ', name = ' . $name . ')';
        } else if (strpos($this->uri, '/repository_data_mapper?delete') === 0) {
            $id = $_GET['delete_id'];
            $results = $repository->repDeleteValue($id);
            $text = 'Удаление записи (id = ' . $id . ')';
        }
        if ($results && $text) {
            $this->lazyTwig($this->twig, $results, $text);
        }
    }
}