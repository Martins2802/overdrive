<?php

if(isset($_GET['logout']) && $_GET['logout'] == 1) {
    $_SESSTION = array();
    session_destroy();

    header('Location: login.php');
}