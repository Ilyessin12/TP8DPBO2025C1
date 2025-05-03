<?php
include_once(__DIR__ . "/../config/connection.php");
include_once(__DIR__ . "/../models/Major.class.php");

class MajorController{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get all majors
    public function getAllMajors(){
        try{
            $query = "SELECT * FROM majors";
            $stmt = $this->db->conn->prepare($query);
            $stmt->execute();
            
            $majors = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $major = new Major(
                    $row['major_id'],
                    $row['major_code'],
                    $row['major_name']
                );
                $majors[] = $major;
            }
            return $majors;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Get major by ID
    public function getMajorById($id){
        try{
            $query = "SELECT * FROM majors WHERE major_id = :id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            
            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $major = new Major(
                    $row['major_id'],
                    $row['major_code'],
                    $row['major_name']
                );
                return $major;
            }
            return null;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Add new major
    public function addMajor($majorCode, $majorName){
        try{
            $query = "INSERT INTO majors (major_code, major_name) VALUES (:code, :name)";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":code", $majorCode);
            $stmt->bindParam(":name", $majorName);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Update major
    public function updateMajor($id, $majorCode, $majorName){
        try{
            $query = "UPDATE majors SET major_code = :code, major_name = :name WHERE major_id = :id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":code", $majorCode);
            $stmt->bindParam(":name", $majorName);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Delete major
    public function deleteMajor($id){
        try{
            $query = "DELETE FROM majors WHERE major_id = :id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
