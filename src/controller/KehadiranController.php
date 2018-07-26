<?php

class KehadiranController {

    public static function ViewHandler() {
        checkAuth();
        $menu_active = 4;

        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM tb_acara WHERE id = 1");
        $stmt->execute();
        $acara = $stmt->fetch(PDO::FETCH_OBJ);
        $waktumulai = strtotime($acara->waktumulai);

        $db = DB::getInstance();
        $stmt = $db->prepare("
          SELECT data_peserta.id, nama, jeniskelamin, namadaerah, namadesa, namakelompok, `time` FROM tb_kehadiran 
          LEFT JOIN 
            (SELECT tb_peserta.id, nama, jeniskelamin, namadaerah, namadesa, namakelompok FROM tb_peserta
             LEFT JOIN tb_daerah ON tb_peserta.iddaerah = tb_daerah.id
             LEFT JOIN tb_desa ON tb_peserta.iddesa = tb_desa.id
             LEFT JOIN tb_kelompok ON tb_peserta.idkelompok = tb_kelompok.id) AS data_peserta
          ON tb_kehadiran.idpeserta = data_peserta.id
          ORDER BY `time` DESC");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        $styles = array("/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css");
        $scripts = array();
        array_push($scripts,"/plugins/jquery-datatable/jquery.dataTables.js");
        array_push($scripts,"/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js");
        array_push($scripts,"/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js");
        array_push($scripts,"/plugins/jquery-datatable/extensions/export/buttons.flash.min.js");
        array_push($scripts,"/plugins/jquery-datatable/extensions/export/jszip.min.js");
        array_push($scripts,"/plugins/jquery-datatable/extensions/export/pdfmake.min.js");
        array_push($scripts,"/plugins/jquery-datatable/extensions/export/vfs_fonts.js");
        array_push($scripts,"/plugins/jquery-datatable/extensions/export/buttons.html5.min.js");
        array_push($scripts,"/plugins/jquery-datatable/extensions/export/buttons.print.min.js");

        require __DIR__ . "/../view/template/mainheader.html";
        require __DIR__ . "/../view/kehadiran.html";
        require __DIR__ . "/../view/template/mainfooter.html";
    }

    public static function DeleteKehadiran() {

        $id = $_GET['id'];

        $db = DB::getInstance();
        $stmt = $db->prepare("DELETE FROM tb_kehadiran WHERE idacara = 1 AND idpeserta = ?");
        $stmt->execute([$id]);

        if ($stmt) {
            header("Location: /main/kehadiran");
        }

        die();

    }

}