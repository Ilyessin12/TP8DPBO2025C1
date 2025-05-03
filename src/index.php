<?php
require_once("config/connection.php");

// Set base URL for header
$baseUrl = "./";

// Page title
$pageTitle = "Student Management System";

// Include header
include("views/templates/header.view.php");
?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="text-center mb-4">Welcome to Student Management System</h2>
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

<div class="row mt-5">
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="card-title">Students</h3>
                <p class="card-text">Manage student information including personal details and academic records.</p>
                <a href="views/students/student.view.php" class="btn btn-primary">Manage Students</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="card-title">Projects</h3>
                <p class="card-text">Track and manage student projects, assignments and their respective status.</p>
                <a href="views/projects/project.view.php" class="btn btn-primary">Manage Projects</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="card-title">Majors</h3>
                <p class="card-text">Add, edit and manage academic majors and related departments.</p>
                <a href="views/majors/major.view.php" class="btn btn-primary">Manage Majors</a>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include("views/templates/footer.view.php");
?>