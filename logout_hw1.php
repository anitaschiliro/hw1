<?php

    session_start();

    session_destroy();

    header("Location: login_hw1.php");
    exit;
?>