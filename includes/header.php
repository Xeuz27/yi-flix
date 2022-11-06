<?php 
require_once("includes/config.php");
require_once("includes/classes/PreviewProvider.php");
require_once("includes/classes/Entity.php");

if( !isset($_SESSION["userLoggedIn"]) ){
    header("location: register.php");
}

$userLoggedIn = $_SESSION["userLoggedIn"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yi-flix | netflix clone for educational purposes</title>
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css">
</head>
<body>
    <div class="wrapper"