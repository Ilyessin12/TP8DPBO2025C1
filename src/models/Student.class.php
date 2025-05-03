<?php
class Student{
    private $id;
    private $name;
    private $nim;
    private $phone;
    private $join_date;
    private $major_id;
    private $created_at;
    private $updated_at;

    public function __construct($id = "", $name = "", $nim = "", $phone = "", $join_date = "", $major_id = "", $created_at = "", $updated_at = ""){
        $this->id = $id;
        $this->name = $name;
        $this->nim = $nim;
        $this->phone = $phone;
        $this->join_date = $join_date;
        $this->major_id = $major_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    // Getters and setters
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getNim(){
        return $this->nim;
    }

    public function setNim($nim){
        $this->nim = $nim;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function getJoinDate(){
        return $this->join_date;
    }

    public function setJoinDate($join_date){
        $this->join_date = $join_date;
    }

    public function getMajorId(){
        return $this->major_id;
    }

    public function setMajorId($major_id){
        $this->major_id = $major_id;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(){
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at){
        $this->updated_at = $updated_at;
    }
}
?>
