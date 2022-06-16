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
        $this->loader = new FilesystemLoader(dirname(__DIR__) . "/templates");
        $this->twig = new Environment($this->loader);
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function showMenu($page){
        ?>
        <button class="button" onclick="window.location.href = 'http://fefu.ml:1613/active_record?'"
                style="margin-left: 30%;">Active Record
        </button>
        <button class="button" onclick="window.location.href = 'http://fefu.ml:1613/repository_data_mapper?'"
                style="margin: 0;">Repository + Data Mapper
        </button>
        <?php
        echo $this->twig->render('input.html.twig', ['page' => $page]);
    }

    protected function lazyTwig($twig, $results, $text)
    {
        echo $twig->render('table.html.twig', ['results' => $results, 'text' => $text]);
    }
}