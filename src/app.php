<?php


/**
 * Application is a singleton class that representing this web application
 */
class Application {

    private $routingTable = array();

    private function __construct() {
        // empty constructor
    }

    public static function Instance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new Application();
        }

        $instance->includeAllController();

        return $instance;
    }

    private function includeAllController() {
        foreach (scandir(dirname(__FILE__)."/controller") as $filename) {
            $path = dirname(__FILE__)."/controller" . '/' . $filename;
            if (is_file($path)) {
                require_once $path;
            }
        }
    }

    public function prepareRouting() {
        require __DIR__.'/route.php';
    }

    private function getCurrentUri() {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        $uri = '/' . trim($uri, '/');
        return $uri;
    }

    public function addRoute($route, $function) {
        $data = array(
            $route => $function,
        );
        $this->routingTable += $data;
    }

    public function Start() {
        $base_url = $this->getCurrentUri();
        $base_url = $this->trimIndexDotPHP($base_url);
        if (array_key_exists ($base_url, $this->routingTable)) {
            $this->routingTable[$base_url]();
        } else {
            header("Location: /404?p=".simpleCrypt($base_url, 'e'));
            die();
        }
    }

    private function trimIndexDotPHP($string) {
        $unnecessaryChars = "/index.php";

        if (strpos($string, $unnecessaryChars) === 0) {
            $result = substr($string, strlen($unnecessaryChars));
            return $result;
        } else {
            return $string;
        }
    }
    
}
