<?php
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/../../controllers/Student.controller.php");
require_once(__DIR__."/../../controllers/Major.controller.php");

// Initialize controllers
$studentController = new StudentController();
$majorController = new MajorController();

// Get all majors for the dropdown
$majors = $majorController->getAllMajors();

$id = $name = $nim = $phone = $join_date = $major_id = "";
$error = "";

// Set base URL for header
$baseUrl = "../../";

// Page title
$pageTitle = "Edit Student";

// Check if ID is provided in URL
if(!isset($_GET['id'])){
    $_SESSION['error'] = "No student ID provided";
    header("Location: ../../index.php");
    exit;
}

$id = $_GET['id'];
$studentData = $studentController->getStudentById($id);

// Check if student exists
if(!$studentData){
    $_SESSION['error'] = "Student not found";
    header("Location: ../../index.php");
    exit;
}

// Get student data
$student = $studentData['student'];
$name = $student->getName();
$nim = $student->getNim();
$phone = $student->getPhone();
$join_date = $student->getJoinDate();
$major_id = $student->getMajorId();

// Process form submission
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $phone = $_POST['phone'];
    $join_date = $_POST['join_date'];
    $major_id = $_POST['major_id'];
    
    try{
        if($studentController->updateStudent($id, $name, $nim, $phone, $join_date, $major_id)){
            $_SESSION['success'] = "Student updated successfully";
            header("Location: ../../index.php");
            exit;
        }
        else{
            $error = "Failed to update student";
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
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Student</h4>
            </div>
            <div class="card-body">
                <?php if(!empty($error)){ ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="join_date" class="form-label">Join Date</label>
                        <input type="date" class="form-control" id="join_date" name="join_date" value="<?php echo $join_date; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="major_id" class="form-label">Major</label>
                        <select class="form-control" id="major_id" name="major_id" required>
                            <option value="">Select Major</option>
                            <?php foreach($majors as $major){ ?>
                                <option value="<?php echo $major->getMajorId(); ?>" <?php echo ($major_id == $major->getMajorId()) ? 'selected' : ''; ?>><?php echo $major->getMajorName(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="../../index.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" name="submit" class="btn btn-warning">Update Student</button>
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