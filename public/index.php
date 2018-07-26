<?php

    $env = getenv('MAHASISWA_ENV');
    if (!$env || $env == "development") {
        $env = "development";
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    require __DIR__.'/../src/app.php';

    $App = Application::Instance();
    $App->prepareRouting();
    $App->Start();