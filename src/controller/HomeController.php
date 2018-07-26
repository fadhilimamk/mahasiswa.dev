<?php

class HomeController {

    public static function HomeHandler() {
        // Checking login user
        checkAuth();

        // Prepare view
        $menu_active = 1;

        $db = DB::getInstance();
        $stmt = $db->prepare("
            SELECT COUNT(*) AS jml_laki FROM tb_kehadiran LEFT JOIN tb_peserta ON tb_kehadiran.idpeserta = tb_peserta.id WHERE jeniskelamin = 'L'
        ");
        $stmt->execute();
        $jmlLaki = $stmt->fetch();
        $jmlLaki = $jmlLaki['jml_laki'];

        $db = DB::getInstance();
        $stmt = $db->prepare("
            SELECT COUNT(*) AS jml_perempuan FROM tb_kehadiran LEFT JOIN tb_peserta ON tb_kehadiran.idpeserta = tb_peserta.id WHERE jeniskelamin = 'P'
        ");
        $stmt->execute();
        $jmlPerempuan = $stmt->fetch();
        $jmlPerempuan = $jmlPerempuan['jml_perempuan'];

        $db = DB::getInstance();
        $stmt = $db->prepare("
            SELECT COUNT(*) AS jml_total FROM tb_kehadiran
        ");
        $stmt->execute();
        $jmlTotal = $stmt->fetch();
        $jmlTotal = $jmlTotal['jml_total'];

        $db = DB::getInstance();
        $stmt = $db->prepare("
            SELECT nama, namadaerah, namadesa, `time` FROM tb_kehadiran LEFT JOIN tb_peserta ON tb_kehadiran.idpeserta = tb_peserta.id LEFT JOIN tb_daerah ON tb_peserta.iddaerah = tb_daerah.id LEFT JOIN tb_desa ON tb_peserta.iddesa = tb_desa.id LEFT JOIN tb_kelompok ON tb_peserta.idkelompok = tb_kelompok.id ORDER BY `time` DESC LIMIT 9
        ");
        $stmt->execute();
        $lastAttendence = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM tb_acara WHERE id = 1");
        $stmt->execute();
        $acara = $stmt->fetch(PDO::FETCH_OBJ);
        $waktumulai = strtotime($acara->waktumulai);

        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) AS jml FROM tb_kehadiran LEFT JOIN tb_peserta ON tb_kehadiran.idpeserta = tb_peserta.id WHERE iddaerah = 1");
        $stmt->execute();
        $jmlBandara = $stmt->fetch();
        $jmlBandara = $jmlBandara['jml'];

        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) AS jml FROM tb_kehadiran LEFT JOIN tb_peserta ON tb_kehadiran.idpeserta = tb_peserta.id WHERE iddaerah = 2");
        $stmt->execute();
        $jmlBarat = $stmt->fetch();
        $jmlBarat = $jmlBarat['jml'];

        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) AS jml FROM tb_kehadiran LEFT JOIN tb_peserta ON tb_kehadiran.idpeserta = tb_peserta.id WHERE iddaerah = 3");
        $stmt->execute();
        $jmlTimur = $stmt->fetch();
        $jmlTimur = $jmlTimur['jml'];

        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) AS jml FROM tb_kehadiran LEFT JOIN tb_peserta ON tb_kehadiran.idpeserta = tb_peserta.id WHERE iddaerah = 4");
        $stmt->execute();
        $jmlSelatan1 = $stmt->fetch();
        $jmlSelatan1 = $jmlSelatan1['jml'];

        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) AS jml FROM tb_kehadiran LEFT JOIN tb_peserta ON tb_kehadiran.idpeserta = tb_peserta.id WHERE iddaerah = 5");
        $stmt->execute();
        $jmlSelatan2 = $stmt->fetch();
        $jmlSelatan2 = $jmlSelatan2['jml'];

        require __DIR__ . "/../view/template/mainheader.html";
        require __DIR__ . "/../view/main.html";
        require __DIR__ . "/../view/template/mainfooter.html";
    }

}