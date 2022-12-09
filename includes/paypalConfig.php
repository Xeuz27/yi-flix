<?php

require_once("../PayPal-PHP-SDK/autoload.php");
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AYnd4CMhN4nOeMTACaLl-jtxKgviHgF2vzi4uGPqPdfrc6Bc-llyPdt9nrijKmWd-LHhMz0ZPQYZ1uTP',     // ClientID
        'EFZLb4m_oPLyflNW0mqNm3QVNnyVW_d-lhUzYSpPE8f9hXdMfkXfWlIzCtqjOdIgZnDZjb4Mw6IfgWPn'      // ClientSecret
    )
);
?>