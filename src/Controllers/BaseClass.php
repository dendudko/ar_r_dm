<?php

namespace Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseClass
{
    protected FilesystemLoader $loader;
    protected Environment $twig;
    protected $uri;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(dirname(__DIR__, 2) . "/templates");
        $this->twig = new Environment($this->loader);
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function showMenu($page)
    {
        if ($page=='active_record'){
            $title='Active Record';
        }
        else if ($page=='repository_data_mapper'){
            $title='Repository + Data Mapper';
        }
        echo $this->twig->render('menu.html.twig',['title'=>$title]);
        echo $this->twig->render('input.html.twig', ['page' => $page]);
    }

    protected function lazyTwig($twig, $results, $text)
    {
        echo $twig->render('table.html.twig', ['results' => $results, 'text' => $text]);
    }
}