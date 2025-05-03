<?php
class Project{
    private $project_id;
    private $project_name;
    private $description;
    private $start_date;
    private $end_date;
    private $student_id;
    private $major_id;
    private $status;

    public function __construct($project_id = "", $project_name = "", $description = "", $start_date = "", $end_date = "", $student_id = "", $major_id = "", $status = ""){
        $this->project_id = $project_id;
        $this->project_name = $project_name;
        $this->description = $description;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->student_id = $student_id;
        $this->major_id = $major_id;
        $this->status = $status;
    }

    // Getters and setters
    public function getProjectId(){
        return $this->project_id;
    }

    public function setProjectId($project_id){
        $this->project_id = $project_id;
    }

    public function getProjectName(){
        return $this->project_name;
    }

    public function setProjectName($project_name){
        $this->project_name = $project_name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getStartDate(){
        return $this->start_date;
    }

    public function setStartDate($start_date){
        $this->start_date = $start_date;
    }

    public function getEndDate(){
        return $this->end_date;
    }

    public function setEndDate($end_date){
        $this->end_date = $end_date;
    }

    public function getStudentId(){
        return $this->student_id;
    }

    public function setStudentId($student_id){
        $this->student_id = $student_id;
    }

    public function getMajorId(){
        return $this->major_id;
    }

    public function setMajorId($major_id){
        $this->major_id = $major_id;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }
}
?>
