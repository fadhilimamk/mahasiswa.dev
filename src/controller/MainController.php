<?php

class MainController {

    public static function DefaultHandler() {
        echo "This is default handler";
    }

    public static function NotFoundHandler() {
        $msg = isset($_GET['p']) ? simpleCrypt($_GET['p'], 'd') : "";

        require __DIR__ . "/../view/template/404.html";
    }

    public static function ErrorHandler() {
        $msg = "";

        if (isset($_GET['e'])) {
            switch ($_GET['e']) {
                case 1 :
                    $msg = "Invalid parameter!";
                    break;
            }
        }

        require __DIR__ . "/../view/template/500.html";
    }

}