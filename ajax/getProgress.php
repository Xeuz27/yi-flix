<?php
require_once("../includes/config.php");

if(isset($_POST["videoId"]) && isset($_POST["username"]) ){
    $query = $con->prepare("SELECT progress from videoProgress where username=:username AND videoId=:videoId");

    $query->bindValue(":username",$_POST["username"]);
    $query->bindValue(":videoId",$_POST["videoId"]);
    $query->execute();

    echo $query->fetchColumn();

}
else {
    echo "no videoId or Username passed in";
}
?>