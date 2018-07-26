<?php

// ---------------------------- LIST OF ALL BASIC ROUTES ----------------------------

$AppInstance = Application::Instance();


$AppInstance->addRoute("/", 'AuthController::FirstHandler');
$AppInstance->addRoute("/login", 'AuthController::LoginHandler');
$AppInstance->addRoute("/register", 'AuthController::RegisterHandler');
$AppInstance->addRoute("/logout", 'AuthController::LogoutHandler');

$AppInstance->addRoute("/main/home", 'HomeController::HomeHandler');
$AppInstance->addRoute("/main/input", 'InputController::ViewHandler');
$AppInstance->addRoute("/main/kehadiran", 'KehadiranController::ViewHandler');
$AppInstance->addRoute("/main/acara", 'AcaraController::ViewHandler');
$AppInstance->addRoute("/main/qrcode", 'QRCodeController::ViewHandler');
$AppInstance->addRoute("/main/pengaturan", 'PengaturanController::ViewHandler');

$AppInstance->addRoute("/main/data/daerah", 'DataController::DaerahHandler');
$AppInstance->addRoute("/main/data/desa", 'MainController::DefaultHandler');
$AppInstance->addRoute("/main/data/kelompok", 'MainController::DefaultHandler');
$AppInstance->addRoute("/main/data/peserta", 'MainController::DefaultHandler');

$AppInstance->addRoute("/404", 'MainController::NotFoundHandler');
$AppInstance->addRoute("/500", 'MainController::ErrorHandler');

// ------------------- Post/Get Handler ----------------------------------
$AppInstance->addRoute("/main/login", 'AuthController::DoLogin');
$AppInstance->addRoute("/main/register", 'AuthController::DoRegister');

$AppInstance->addRoute("/kehadiran/delete", 'KehadiranController::DeleteKehadiran');

$AppInstance->addRoute("/main/rekap/gender", 'HomeController::RekapGender');

$AppInstance->addRoute("/main/acara/edit", 'AcaraController::EditAcara');

$AppInstance->addRoute("/main/input/peserta", 'InputController::GetPeserta');
$AppInstance->addRoute("/main/input/kehadiran", 'InputController::CreateKehadiran');
$AppInstance->addRoute("/main/input/kehadiran/tambah", 'InputController::CreateNewPeserta');
$AppInstance->addRoute("/main/input/rekap", 'InputController::GetSimpleRekap');