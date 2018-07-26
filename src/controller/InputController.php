<?php

class InputController {

    public static function ViewHandler() {
        // Checking login user
        checkAuth();

        // Preparing detail of event
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM tb_acara WHERE id = 1");
        $stmt->execute();
        $acara = $stmt->fetch(PDO::FETCH_OBJ);
        $starttime = $acara->waktumulai;
        $acara->waktumulai = date("l, j F Y", strtotime($starttime));
        $acara = (array)$acara;
        $acara['jammulai'] = date("H.i", strtotime($starttime));
        $acara['jamselesai'] = date("H.i", strtotime($acara['waktuselesai']));
        $acara = (object)$acara;

        // Preparing data for register new peserta
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM tb_daerah");
        $stmt->execute();
        $datadaerah = $stmt->fetchAll();
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM tb_desa");
        $stmt->execute();
        $datadesa = $stmt->fetchAll();
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM tb_kelompok");
        $stmt->execute();
        $datakelompok = $stmt->fetchAll();

        $styles = array();
        array_push($styles, "/plugins/easy-autocomplete/easy-autocomplete.css");
        array_push($styles, "/css/font-awesome.min.css");

        $title = "Input";
        $menu_active = 5;

        require __DIR__ . "/../view/template/mainheader.html";
        require __DIR__ . "/../view/input.html";
        require __DIR__ . "/../view/template/mainfooter.html";
    }

    public static function GetPeserta() {
        $q = "";
        $limit = 5;
        if (isset($_GET['q'])) {
            $q = $_GET['q'];
        }
        if (isset($_GET['limit'])) {
            $limit = $_GET['limit'];
            if ($limit > 50) {
                $limit = 50;
            }
        }

        $db = DB::getInstance();
        $stmt = $db->prepare("
            SELECT tb_peserta.id, nama, jeniskelamin, namadaerah AS daerah, namadesa AS desa, namakelompok AS kelompok
            FROM tb_peserta 
            LEFT JOIN tb_daerah ON tb_peserta.iddaerah = tb_daerah.id
            LEFT JOIN tb_desa ON tb_peserta.iddesa = tb_desa.id
            LEFT JOIN tb_kelompok ON tb_peserta.idkelompok = tb_kelompok.id 
            WHERE nama LIKE ? LIMIT ?");
        $stmt->execute(["%$q%", $limit]);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($data);

    }

    public static function CreateKehadiran() {
        if (!isset($_POST['id'])) {
            die("wrong attribute!");
        }

        $acara = 1;
        $id = $_POST['id'];

        // Check user existance
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT nama FROM tb_peserta WHERE id = ?");
        if ($stmt->execute([$id]) && $stmt->rowCount() != 0) {
            $nama = $stmt->fetch(PDO::FETCH_OBJ);
            $nama = $nama->nama;

            // Check if already coming
            $db = DB::getInstance();
            $stmt = $db->prepare("SELECT * FROM tb_kehadiran WHERE idacara = ? AND idpeserta = ?");
            $stmt->execute([$acara, $id]);
            if ($stmt->rowCount() != 0) {
                echo json_encode(['status' => 'error', 'msg' => 'Peserta sudah hadir sebelumnya']);
                return;
            }

            $db = DB::getInstance();
            $stmt = $db->prepare("INSERT INTO tb_kehadiran (idacara, idpeserta) VALUES (?,?)");
            if ($stmt->execute([$acara, $id])) {
                echo json_encode(['status' => 'success', 'msg' =>$nama]);
            } else {
                echo json_encode(['status' => 'error', 'msg' => 'Gagal input ke database!']);
            }
        } else {
            $retrn = ['status' => 'errror', 'msg' => 'User tidak ditemukan'];
            echo json_encode($retrn);
        }

    }

    public static function GetSimpleRekap() {
        $db = DB::getInstance();
        $stmt = $db->prepare("
            SELECT 
                SUM(CASE WHEN jeniskelamin = 'L' THEN 1 ELSE 0 END) as lakilaki_count,
                SUM(CASE WHEN jeniskelamin = 'P' THEN 1 ELSE 0 END) as perempuan_count,
                COUNT(*) as total
            FROM tb_kehadiran LEFT JOIN 
            (SELECT id, jeniskelamin FROM tb_peserta) AS tb_peserta ON tb_kehadiran.idpeserta = tb_peserta.id"
        );
        $stmt->execute();
        $rekap = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$rekap->lakilaki_count) {
            $rekap->lakilaki_count = 0;
        }
        if (!$rekap->perempuan_count) {
            $rekap->perempuan_count = 0;
        }

        echo json_encode($rekap);
        die();
    }

    public static function CreateNewPeserta() {
        if (!isset($_POST['nama']) || !isset($_POST['daerah']) || !isset($_POST['desa']) || !isset($_POST['jeniskelamin'])) {
            MainController::ErrorHandler();
            die();
        }

        $nama = $_POST['nama'];
        $daerah = $_POST['daerah'];
        $desa = $_POST['desa'];
        $kelompok = isset($_POST['kelompok']) ? $_POST['kelompok'] : "";
        $jeniskelamin = $_POST['jeniskelamin'];

        $db = DB::getInstance();
        $stmt = $db->prepare("
            INSERT INTO tb_peserta (nama, jeniskelamin, iddaerah, iddesa, idkelompok)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$nama, $jeniskelamin, $daerah, $desa, $kelompok]);
        $id = $db->lastInsertId();

        $db = DB::getInstance();
        $stmt = $db->prepare("
            INSERT INTO tb_kehadiran (idacara, idpeserta)
            VALUES (?, ?)
        ");
        $stmt->execute([1, $id]);

        if ($stmt) {
            header("Location: /main/input?i=1");
        } else {
            MainController::ErrorHandler();
        }
        die();
    }

}