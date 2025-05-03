<?php
include_once(__DIR__ . "/../config/connection.php");
include_once(__DIR__ . "/../models/Project.class.php");

class ProjectController{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get all projects with related student and major information
    public function getAllProjects(){
        try{
            $query = "SELECT p.*, s.name as student_name, m.major_name 
                      FROM projects p 
                      LEFT JOIN students s ON p.student_id = s.id 
                      LEFT JOIN majors m ON p.major_id = m.major_id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->execute();
            
            $projects = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $project = new Project(
                    $row['project_id'],
                    $row['project_name'],
                    $row['description'],
                    $row['start_date'],
                    $row['end_date'],
                    $row['student_id'],
                    $row['major_id'],
                    $row['status']
                );
                // Store additional data in structured array
                $projects[] = [
                    'project' => $project,
                    'student_name' => $row['student_name'],
                    'major_name' => $row['major_name']
                ];
            }
            return $projects;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Get project by ID
    public function getProjectById($id){
        try{
            $query = "SELECT p.*, s.name as student_name, m.major_name 
                      FROM projects p 
                      LEFT JOIN students s ON p.student_id = s.id 
                      LEFT JOIN majors m ON p.major_id = m.major_id
                      WHERE p.project_id = :id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            
            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $project = new Project(
                    $row['project_id'],
                    $row['project_name'],
                    $row['description'],
                    $row['start_date'],
                    $row['end_date'],
                    $row['student_id'],
                    $row['major_id'],
                    $row['status']
                );
                // Return structured array with all data
                return [
                    'project' => $project,
                    'student_name' => $row['student_name'],
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

    // Add new project
    public function addProject($project_name, $description, $start_date, $end_date, $student_id, $major_id, $status){
        try{
            $query = "INSERT INTO projects (project_name, description, start_date, end_date, 
                      student_id, major_id, status) 
                      VALUES (:name, :desc, :start, :end, :student_id, :major_id, :status)";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":name", $project_name);
            $stmt->bindParam(":desc", $description);
            $stmt->bindParam(":start", $start_date);
            $stmt->bindParam(":end", $end_date);
            $stmt->bindParam(":student_id", $student_id);
            $stmt->bindParam(":major_id", $major_id);
            $stmt->bindParam(":status", $status);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Update project
    public function updateProject($id, $project_name, $description, $start_date, $end_date, $student_id, $major_id, $status){
        try{
            $query = "UPDATE projects SET project_name = :name, description = :desc, 
                      start_date = :start, end_date = :end, student_id = :student_id,
                      major_id = :major_id, status = :status 
                      WHERE project_id = :id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":name", $project_name);
            $stmt->bindParam(":desc", $description);
            $stmt->bindParam(":start", $start_date);
            $stmt->bindParam(":end", $end_date);
            $stmt->bindParam(":student_id", $student_id);
            $stmt->bindParam(":major_id", $major_id);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Delete project
    public function deleteProject($id){
        try{
            $query = "DELETE FROM projects WHERE project_id = :id";
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

    // Get projects by student ID
    public function getProjectsByStudentId($studentId){
        try{
            $query = "SELECT p.*, m.major_name 
                      FROM projects p 
                      LEFT JOIN majors m ON p.major_id = m.major_id
                      WHERE p.student_id = :student_id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":student_id", $studentId);
            $stmt->execute();
            
            $projects = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $project = new Project(
                    $row['project_id'],
                    $row['project_name'],
                    $row['description'],
                    $row['start_date'],
                    $row['end_date'],
                    $row['student_id'],
                    $row['major_id'],
                    $row['status']
                );
                $projects[] = [
                    'project' => $project,
                    'major_name' => $row['major_name']
                ];
            }
            return $projects;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Get projects by major ID
    public function getProjectsByMajorId($majorId){
        try{
            $query = "SELECT p.*, s.name as student_name 
                      FROM projects p 
                      LEFT JOIN students s ON p.student_id = s.id
                      WHERE p.major_id = :major_id";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bindParam(":major_id", $majorId);
            $stmt->execute();
            
            $projects = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $project = new Project(
                    $row['project_id'],
                    $row['project_name'],
                    $row['description'],
                    $row['start_date'],
                    $row['end_date'],
                    $row['student_id'],
                    $row['major_id'],
                    $row['status']
                );
                $projects[] = [
                    'project' => $project,
                    'student_name' => $row['student_name']
                ];
            }
            return $projects;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}
?>
