<?php
require_once("includes/header.php");
if(!isset($_GET["id"])){
    ErrorMessage::show("No Id Found in url");
}


$video = new Video($con, $_GET["id"]);
var_dump($video);
$video->incrementViews();
?>