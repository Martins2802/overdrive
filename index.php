<?php

use Src\Controllers\Services\PageController;

    require('./vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
    $dotenv->load();

    $url = new PageController;
    $url -> loadPage();