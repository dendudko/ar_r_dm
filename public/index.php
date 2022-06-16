<?php

use Classes\ActiveRecord;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

require_once dirname(__DIR__) . "/vendor/autoload.php";
$loader = new FilesystemLoader(dirname(__DIR__) . "/templates");
$twig = new Environment($loader);

$ar = new ActiveRecord();

function lazyTwig($twig, $results, $text)
{
    echo $twig->render('table.html.twig', ['results' => $results, 'text' => $text]);
}

?>
    <button class="button" onclick="window.location.href = 'http://fefu.ml:1613/active_record?'"
            style="margin-left: 30%;">Active Record
    </button>
    <button class="button" onclick="window.location.href = 'http://fefu.ml:1613/repository_data_mapper?'"
            style="margin: 0;">Repository + Data Mapper
    </button>
<?php

$uri = $_SERVER['REQUEST_URI'];
if ($uri == '/') {
    header('Location: /active_record?');
}

if (strpos($uri, '/active_record') === 0) {
    echo $twig->render('input.html.twig', ['page' => 'active_record']);
    if (strpos($uri, '/active_record?select_all') === 0) {
        $results = $ar->selectAll();
        $text = 'Все записи';
        lazyTwig($twig, $results, $text);
    } else if (strpos($uri, '/active_record?search_id') === 0) {
        $id = $_GET['search_id'];
        $results = $ar->searchById($id);
        $text = 'Поиск по ID (id = ' . $id . ')';
        lazyTwig($twig, $results, $text);
    } else if (strpos($uri, '/active_record?search_name') === 0) {
        $name = $_GET['search_name'];
        $results = $ar->searchByName($name);
        $text = 'Поиск по имени (name = ' . $name . ')';
        lazyTwig($twig, $results, $text);
    } else if (strpos($uri, '/active_record?insert') === 0) {
        $id = $_GET['insert_id'];
        $name = $_GET['insert_name'];
        $results = $ar->saveValue($id, $name);
        $text = 'Добавление записи (id = ' . $id . ', name = ' . $name . ')';
        lazyTwig($twig, $results, $text);
    } else if (strpos($uri, '/active_record?delete') === 0) {
        $id = $_GET['delete_id'];
        $results = $ar->deleteValue($id);
        $text = 'Удаление записи (id = ' . $id . ')';
        lazyTwig($twig, $results, $text);
    }
} else if (strpos($uri, '/repository_data_mapper?') === 0) {

}

