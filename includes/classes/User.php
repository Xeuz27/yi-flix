<?php
class User {
    private $con, $sqlData;
    public function __construct( $con, $username){
        $this->con = $con;
        
        $query = $con->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindValue(":username", $username);
        $query->execute();
        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getfirstName(){
        return $this->sqlData["firstName"];
    }
    public function getlastName(){
        return $this->sqlData["lastName"];
    }
    public function getemail(){
        return $this->sqlData["email"];
    }

    public function getIsSubscribed(){
        return $this->sqlData["isSubscribed"];
    }

}

?>