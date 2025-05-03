<?php
require_once(__DIR__ . "/../../config/connection.php");
require_once(__DIR__ . "/../../controllers/Project.controller.php");

// Initialize controller
$projectController = new ProjectController();

// Get all projects with student and major names
$projectData = $projectController->getAllProjects();

// Set base URL for header
$baseUrl = "../../";

// Page title
$pageTitle = "Project List";

// Include header
include(__DIR__."/../../views/templates/header.view.php");
?>

<!-- add project button -->
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Project List</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="create.view.php" class="btn btn-primary">Add New Project</a>
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
            <th>Project Name</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Student</th>
            <th>Major</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($projectData)){
            foreach($projectData as $data){
                $project = $data['project'];
                echo "<tr>
                        <td>{$project->getProjectId()}</td>
                        <td>{$project->getProjectName()}</td>
                        <td>" . nl2br(htmlspecialchars($project->getDescription())) . "</td>
                        <td>{$project->getStartDate()}</td>
                        <td>{$project->getEndDate()}</td>
                        <td>{$data['student_name']}</td>
                        <td>{$data['major_name']}</td>
                        <td>{$project->getStatus()}</td>
                        <td>
                            <a href='edit.view.php?id={$project->getProjectId()}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete.view.php?id={$project->getProjectId()}' class='btn btn-sm btn-danger' 
                               onclick='return confirm(\"Are you sure you want to delete this project?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        }
        else{
            echo "<tr><td colspan='9' class='text-center'>No projects found</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
// Include footer
include(__DIR__."/../../views/templates/footer.view.php");
?>
