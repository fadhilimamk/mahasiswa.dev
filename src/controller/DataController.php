<?php

class DataController {

    public static function DaerahHandler() {
        // Checking login user
        checkAuth();

        // Prepare view
        $menu_active = 2;

        require __DIR__ . "/../view/template/mainheader.html";
        require __DIR__ . "/../view/daerah.html";
        require __DIR__ . "/../view/template/mainfooter.html";
    }

}