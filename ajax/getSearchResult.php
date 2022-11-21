<?php
require_once("../includes/config.php");
require_once("../includes/classes/searchResultsProvider.php");
require_once("../includes/classes/EntityProvider.php");
require_once("../includes/classes/Entity.php");
require_once("../includes/classes/PreviewProvider.php");

if(isset($_POST["term"]) && isset($_POST["username"]) ){
    $searchResultsProvider = new searchResultsProvider($con, $_POST["username"]);

    echo $searchResultsProvider->getResults($_POST["term"]);
}
else {
    echo "no term or Username passed in";
}
?>