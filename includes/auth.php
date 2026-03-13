<?php
session_start();

/* Check if user is logged in */
function check_auth() {

    if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {

        header("Location: ../secure/login.php");
        exit();

    }
}
?>