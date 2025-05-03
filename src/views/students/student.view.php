<?php
require_once(__DIR__ . "/../../config/connection.php");
require_once(__DIR__ . "/../../controllers/Student.controller.php");
require_once(__DIR__ ."/../../controllers/Major.controller.php");

// Initialize controllers
$studentController = new StudentController();
$majorController = new MajorController();

// Get all students
$studentData = $studentController->getAllStudents();

// Set base URL for header
$baseUrl = "../../";

// Page title
$pageTitle = "Student List";

// Include header
include(__DIR__."/../../views/templates/header.view.php");
?>

<!-- add student button -->
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Student List</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="create.view.php" class="btn btn-primary">Add New Student</a>
    </div>
</div>

<?php
if(isset($_SESSION['success'])){
    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
if(isset($_SESSION['error'])){
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>NIM</th>
            <th>Phone</th>
            <th>Join Date</th>
            <th>Major</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($studentData)){
            foreach($studentData as $data){
                $student = $data['student'];
                echo "<tr>
                        <td>{$student->getId()}</td>
                        <td>{$student->getName()}</td>
                        <td>{$student->getNim()}</td>
                        <td>{$student->getPhone()}</td>
                        <td>{$student->getJoinDate()}</td>
                        <td>{$data['major_name']}</td>
                        <td>
                            <a href='edit.view.php?id={$student->getId()}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete.view.php?id={$student->getId()}' class='btn btn-sm btn-danger' 
                               onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        }
        else{
            echo "<tr><td colspan='7' class='text-center'>No students found</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
// Include footer
include("../../views/templates/footer.view.php");
?>