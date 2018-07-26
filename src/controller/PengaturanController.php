<?php

class PengaturanController {

    public static function ViewHandler() {
        // Checking login user
        checkAuth();
//
//        $db = DB::getInstance();
//        $stmt = $db->prepare("SELECT * FROM tb_acara WHERE id = 1");
//        $stmt->execute();
//        $acara = $stmt->fetch(PDO::FETCH_OBJ);
//        $acara->waktumulai = date("l j F Y, G:i", strtotime($acara->waktumulai));
//        $acara->waktuselesai= date("l j F Y, G:i", strtotime($acara->waktuselesai));

        $menu_active = 6;

        require __DIR__ . "/../view/template/mainheader.html";
        require __DIR__ . "/../view/pengaturan.html";
        require __DIR__ . "/../view/template/mainfooter.html";
    }

    public static function EditProfil() {

    }

}