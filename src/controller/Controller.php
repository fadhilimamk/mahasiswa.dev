<?php

// ----------------------- Setting Up Global Connection -----------------------------------

class DB {
    private $_db;
    static $_instance;

    private function __construct() {

        $dbhost = 'localhost';
        $dbuser = 'phpmyadmin';
        $dbpass = 'rahasia';
        $dbname = 'db_mahasiswa';

        try {
            $this->_db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            echo "Connection fail :".$e->getMessage();
        }

    }

    private function __clone(){}

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance->_db;
    }

}


// ------------------------------ Helper Function ----------------------------------------


function simpleCrypt( $string, $action = 'e' ) {
    
    $secret_key = 'dagojek_key';
    $secret_iv = 'dagojek_iv';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}

function checkAuth() {
    session_start();
    if (!isset($_SESSION['auth'])) {
        header("Location: /");
        die();
    }
}
