<?php
// Huvudkontroller
namespace App;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Database/Database.php';
class Controller
{
    protected $db;
    
    /**
     * __construct
     * Vi använder instantiering av alla controllers som extendar denna controller för att ta del av vår
     * singleton DB instans.
     * @return void
     */
    public function __construct()
    {
    $this->db = Database::getInstance()->getConnection();
    }    
    /**
     * render
     * Detta är render metoden, denna kommer användas för att visa "views" med hjälp av
     * deras respektive controllers.
     * @param  mixed $view
     * @param  mixed $data
     * @return void
     */
    protected function render($view, $data = [])
    {
        extract($data);

        ob_start();
        include "Views/$view.php";
        $content = ob_get_clean();
        include "Views/layout.php";
    }
}