<?php
require_once(__DIR__ ."/../../config/connection.php");
require_once(__DIR__ ."/../../controllers/Student.controller.php");

// Initialize controller
$studentController = new StudentController();

// Check if ID is provided
if(!isset($_GET['id'])){
    $_SESSION['error'] = "No student ID provided";
    header("Location: ../../index.php");
    exit;
}

$id = $_GET['id'];

try{
    // Delete the student
    if($studentController->deleteStudent($id)){
        $_SESSION['success'] = "Student deleted successfully";
    }
    else{
        $_SESSION['error'] = "Failed to delete student";
    }
}
catch(Exception $e){
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

// Redirect back to the student list
header("Location: ../../index.php");
exit;
?>