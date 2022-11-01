<?php
ob_start();
session_start();

date_default_timezone_set("Etc/GMT-4");

try {
    $con = new PDO("mysql:dbname=yisflixdb;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);//allows error reporting from db connection
} catch (PDOException $error) {
    exit("Connection failed: ". $error->getMessage() );
}

?>