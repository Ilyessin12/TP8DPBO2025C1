<?php
require_once(__DIR__ ."/../../config/connection.php");
require_once(__DIR__ ."/../../controllers/Major.controller.php");

// Initialize controller
$majorController = new MajorController();

// Check if ID is provided
if(!isset($_GET['id'])){
    $_SESSION['error'] = "No major ID provided";
    header("Location: major.view.php");
    exit;
}

$id = $_GET['id'];

try{
    // Delete the major
    if($majorController->deleteMajor($id)){
        $_SESSION['success'] = "Major deleted successfully";
    }
    else{
        // Check if the error is due to foreign key constraint
        // This requires specific error handling based on your DB setup or controller logic
        $_SESSION['error'] = "Failed to delete major. It might be associated with existing students or projects.";
    }
}
catch(PDOException $e){
    // Check for foreign key constraint violation error code (e.g., 23000 for SQLSTATE)
    if($e->getCode() == '23000'){
        $_SESSION['error'] = "Cannot delete major: It is currently assigned to one or more students or projects.";
    } else {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}
catch(Exception $e){
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

// Redirect back to the major list
header("Location: major.view.php");
exit;
?>
