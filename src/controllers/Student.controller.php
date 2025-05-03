<?php
include_once(__DIR__ . "/../config/connection.php");
include_once(__DIR__ . "/../models/Student.class.php");

class StudentController{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get all students with major information
    public function getAllStudents(){
        try{
            $query = "SELECT s.*, m.major_name FROM students s 
                      LEFT JOIN majors m ON s.major_id = m.major_id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->execute();
            
            $students = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $student = new Student(
                    $row['id'],
                    $row['name'],
                    $row['nim'],
                    $row['phone'],
                    $row['join_date'],
                    $row['major_id'],
                    $row['created_at'],
                    $row['updated_at']
                );
                // Store major data as an array instead of direct property
                $students[] = [
                    'student' => $student,
                    'major_name' => $row['major_name']
                ];
            }
            return $students;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Get student by ID
    public function getStudentById($id){
        try{
            $query = "SELECT s.*, m.major_name FROM students s 
                      LEFT JOIN majors m ON s.major_id = m.major_id
                      WHERE s.id = :id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            
            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $student = new Student(
                    $row['id'],
                    $row['name'],
                    $row['nim'],
                    $row['phone'],
                    $row['join_date'],
                    $row['major_id'],
                    $row['created_at'],
                    $row['updated_at']
                );
                // Return both student and major_name as array
                return [
                    'student' => $student,
                    'major_name' => $row['major_name']
                ];
            }
            return null;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Add new student
    public function addStudent($name, $nim, $phone, $join_date, $major_id){
        try{
            $query = "INSERT INTO students (name, nim, phone, join_date, major_id) 
                      VALUES (:name, :nim, :phone, :join_date, :major_id)";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":nim", $nim);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":join_date", $join_date);
            $stmt->bindParam(":major_id", $major_id);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Update student
    public function updateStudent($id, $name, $nim, $phone, $join_date, $major_id){
        try{
            $query = "UPDATE students SET name = :name, nim = :nim, phone = :phone, 
                      join_date = :join_date, major_id = :major_id 
                      WHERE id = :id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":nim", $nim);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":join_date", $join_date);
            $stmt->bindParam(":major_id", $major_id);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Delete student
    public function deleteStudent($id){
        try{
            $query = "DELETE FROM students WHERE id = :id";
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
