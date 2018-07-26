<?php

class AcaraController {

    public static function ViewHandler() {
        // Checking login user
        checkAuth();

        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM tb_acara WHERE id = 1");
        $stmt->execute();
        $acara = $stmt->fetch(PDO::FETCH_OBJ);
        $acara->waktumulai = date("l j F Y, G:i", strtotime($acara->waktumulai));
        $acara->waktuselesai= date("l j F Y, G:i", strtotime($acara->waktuselesai));

        $styles = array("/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css");

        $menu_active = 3;

        require __DIR__ . "/../view/template/mainheader.html";
        require __DIR__ . "/../view/acara.html";
        require __DIR__ . "/../view/template/mainfooter.html";
    }

    public static function EditAcara() {
        $nama = $_POST['nama'];
        $tempat = $_POST['tempat'];
        $waktumulai = $_POST['waktumulai'];
        $waktuselesai = $_POST['waktuselesai'];

        $waktumulai = date('Y-m-d H:i:s',strtotime($waktumulai));
        $waktuselesai = date('Y-m-d H:i:s',strtotime($waktuselesai));

        $db = DB::getInstance();
        $stmt = $db->prepare("UPDATE tb_acara SET namaacara  = ?, tempat = ?, waktumulai = ?, waktuselesai = ? WHERE id = 1");
        if ($stmt->execute([$nama, $tempat, $waktumulai, $waktuselesai])) {
            header("Location: /main/acara");
            die();
        };

    }

}