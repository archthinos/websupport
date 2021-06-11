<?php 
namespace Core;

class View {

    public static function render($view, $data = [])
    {
        extract($data, EXTR_SKIP);

        $file = dirname(__DIR__) . "/app/views/$view.view.php";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
}