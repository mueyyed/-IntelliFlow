<?php
// include language configuration file based on selected language
$lang = "ar";
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
}
if( isset( $_SESSION['lang'] ) ) {
    $lang = $_SESSION['lang'];
}else {
    $lang = "ar";
}



require_once ($_ENV['APP_ROOT']."assets/lang/" . $lang . ".php");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
