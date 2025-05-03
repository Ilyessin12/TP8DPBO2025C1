<?php
require_once(__DIR__ . "/../../config/connection.php");
require_once(__DIR__ . "/../../controllers/Major.controller.php");

// Initialize controller
$majorController = new MajorController();

// Get all majors
$majors = $majorController->getAllMajors();

// Set base URL for header
$baseUrl = "../../";

// Page title
$pageTitle = "Major List";

// Include header
include(__DIR__."/../../views/templates/header.view.php");
?>

<!-- add major button -->
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Major List</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="create.view.php" class="btn btn-primary">Add New Major</a>
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
            <th>Major Code</th>
            <th>Major Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($majors)){
            foreach($majors as $major){
                echo "<tr>
                        <td>{$major->getMajorId()}</td>
                        <td>{$major->getMajorCode()}</td>
                        <td>{$major->getMajorName()}</td>
                        <td>
                            <a href='edit.view.php?id={$major->getMajorId()}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete.view.php?id={$major->getMajorId()}' class='btn btn-sm btn-danger' 
                               onclick='return confirm(\"Are you sure you want to delete this major? Deleting this major might affect related students and projects.\");'>Delete</a>
                        </td>
                      </tr>";
            }
        }
        else{
            echo "<tr><td colspan='4' class='text-center'>No majors found</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
// Include footer
include(__DIR__."/../../views/templates/footer.view.php");
?>
