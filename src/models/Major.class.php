<?php
class Major{
    private $major_id;
    private $major_code;
    private $major_name;

    public function __construct($major_id = "", $major_code = "", $major_name = ""){
        $this->major_id = $major_id;
        $this->major_code = $major_code;
        $this->major_name = $major_name;
    }

    // Getters and setters
    public function getMajorId(){
        return $this->major_id;
    }

    public function setMajorId($major_id){
        $this->major_id = $major_id;
    }

    public function getMajorCode(){
        return $this->major_code;
    }

    public function setMajorCode($major_code){
        $this->major_code = $major_code;
    }

    public function getMajorName(){
        return $this->major_name;
    }

    public function setMajorName($major_name){
        $this->major_name = $major_name;
    }
}
?>
