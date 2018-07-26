<?php

class AuthController {

    public static function FirstHandler() {

        AuthController::LoginHandler();
    }

    public static function LoginHandler() {

        $msg = "";

        if (isset($_GET['error'])) {
            switch($_GET['error']) {
                case 1 : $msg = "Akun tidak ditemukan";
            }
        }

        require __DIR__ . "/../view/template/header.html";
        require __DIR__ . "/../view/login.html";
        require __DIR__ . "/../view/template/footer.html";
    }

    public static function DoLogin() {
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            require __DIR__ . "/../view/template/500.html";
            return;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];


        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM tb_user WHERE email = ? AND password = MD5(?)");

        if ($stmt->execute([$email, $password]) && $stmt->rowCount() != 0) {
            session_start();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $_SESSION['auth'] = simpleCrypt($email.$password, 'e');
            $_SESSION['name'] = $user->nama;
            $_SESSION['email'] = $user->email;
            header("Location: /main/home");
            die();
        } else {
            header("Location: /login?error=1");
            die();
        }
    }

    public static function RegisterHandler() {

        require __DIR__ . "/../view/template/header.html";
        require __DIR__ . "/../view/register.html";
        require __DIR__ . "/../view/template/footer.html";
    }

    public static function DoRegister() {
        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            MainController::ErrorHandler();
            die();
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO tb_user (nama, email, password) VALUES (?,?,MD5(?))");
        if ($stmt->execute([$name, $email, $password])) {
            header("Location: /login");
            die();
        } else {
            MainController::ErrorHandler();
            die();
        }
    }

    public static function LogoutHandler() {
        session_start();
        unset($_SESSION['auth']);
        header("Location: /");
        die();
    }


}