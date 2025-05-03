<?php
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/../../controllers/Project.controller.php");
require_once(__DIR__."/../../controllers/Student.controller.php");
require_once(__DIR__."/../../controllers/Major.controller.php");

// Initialize controllers
$projectController = new ProjectController();
$studentController = new StudentController();
$majorController = new MajorController();

// Get all students and majors for dropdowns
$studentsData = $studentController->getAllStudents(); // Assuming this returns array ['student' => object, 'major_name' => string]
$majors = $majorController->getAllMajors();

$error = '';

// Set base URL for header
$baseUrl = "../../";

// Page title
$pageTitle = "Add New Project";

// Process form submission
if(isset($_POST['submit'])){
    $project_name = $_POST['project_name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : null; // Handle optional end date
    $student_id = $_POST['student_id'];
    $major_id = $_POST['major_id'];
    $status = $_POST['status'];
    
    try{
        if($projectController->addProject($project_name, $description, $start_date, $end_date, $student_id, $major_id, $status)){
            $_SESSION['success'] = "Project added successfully";
            header("Location: project.view.php"); // Redirect to project list
            exit;
        }
        else{
            $error = "Failed to add project";
        }
    }
    catch(Exception $e){
        $error = "Error: " . $e->getMessage();
    }
}

// Include header
include(__DIR__."/../templates/header.view.php");
?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add New Project</h4>
            </div>
            <div class="card-body">
                <?php if(!empty($error)){ ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="project_name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="project_name" name="project_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date (Optional)</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student</label>
                        <select class="form-control" id="student_id" name="student_id" required>
                            <option value="">Select Student</option>
                            <?php foreach($studentsData as $data){ 
                                $student = $data['student']; ?>
                                <option value="<?php echo $student->getId(); ?>"><?php echo $student->getName(); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="major_id" class="form-label">Major</label>
                        <select class="form-control" id="major_id" name="major_id" required>
                            <option value="">Select Major</option>
                            <?php foreach($majors as $major){ ?>
                                <option value="<?php echo $major->getMajorId(); ?>"><?php echo $major->getMajorName(); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Planned">Planned</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="project.view.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" name="submit" class="btn btn-primary">Save Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include(__DIR__."/../templates/footer.view.php");
?>
