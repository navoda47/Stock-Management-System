<?php


session_start();


if (isset($_SESSION["uid"])) {
    $_SESSION = [];
    session_destroy();
}


header("location: index.php");

