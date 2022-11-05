<?php
class Entity {
    private $con $input
    public function __construc($con, $input){
        $this->con = $con;

        if(is_array($input)) {
            $this->sqlData = $input;
        } 
        else {
            $query = $this->con->prepare("SELECT * FROM ENTITIES WHERE id=:id")
            $query->bindValue(":id", $input);
           $query->execute();

           $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }
    }
}

?>
