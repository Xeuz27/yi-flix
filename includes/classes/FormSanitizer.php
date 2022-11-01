<?php
class FormSanitizer{
    
    public static function sanitizeFormString($inputText) {
        $inputText = strip_tags($inputText); //removes html tags 
        $inputText = str_replace(" ", "", $inputText); //removes spaces
        //$inputText = trim($inputText);
        $inputText = strtolower($inputText);
        $inputText = ucfirst($inputText);
        return $inputText;
    }

}


?>