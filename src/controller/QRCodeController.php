<?php

class QRCodeController {

    public static function ViewHandler() {
        checkAuth();
        $menu_active = 3;

        require __DIR__ . "/../view/template/mainheader.html";
        require __DIR__ . "/../view/template/mainfooter.html";
    }

}