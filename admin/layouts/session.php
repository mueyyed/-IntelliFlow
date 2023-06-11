<?php
// Initialize the session
session_start();

require __DIR__ .'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');

$dotenv->load();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ".$_ENV['APP_URL']."auth-login.php");
    exit;
}

