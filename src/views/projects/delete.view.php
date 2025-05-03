<?php
require_once(__DIR__ ."/../../config/connection.php");
require_once(__DIR__ ."/../../controllers/Project.controller.php");

// Initialize controller
$projectController = new ProjectController();

// Check if ID is provided
if(!isset($_GET['id'])){
    $_SESSION['error'] = "No project ID provided";
    header("Location: project.view.php");
    exit;
}

$id = $_GET['id'];

try{
    // Delete the project
    if($projectController->deleteProject($id)){
        $_SESSION['success'] = "Project deleted successfully";
    }
    else{
        $_SESSION['error'] = "Failed to delete project";
    }
}
catch(Exception $e){
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

// Redirect back to the project list
header("Location: project.view.php");
exit;
?>
