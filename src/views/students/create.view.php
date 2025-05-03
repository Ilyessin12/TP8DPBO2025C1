<?php
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/../../controllers/Student.controller.php");
require_once(__DIR__."/../../controllers/Major.controller.php");

// Initialize controllers
$studentController = new StudentController();
$majorController = new MajorController();

// Get all majors for the dropdown
$majors = $majorController->getAllMajors();

$error = '';

// Set base URL for header
$baseUrl = "../../";

// Page title
$pageTitle = "Add New Student";

// Process form submission
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $phone = $_POST['phone'];
    $join_date = $_POST['join_date'];
    $major_id = $_POST['major_id'];
    
    try{
        if($studentController->addStudent($name, $nim, $phone, $join_date, $major_id)){
            $_SESSION['success'] = "Student added successfully";
            header("Location: ../../index.php");
            exit;
        }
        else{
            $error = "Failed to add student";
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
                <h4 class="mb-0">Add New Student</h4>
            </div>
            <div class="card-body">
                <?php if(!empty($error)){ ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="join_date" class="form-label">Join Date</label>
                        <input type="date" class="form-control" id="join_date" name="join_date" required>
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
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="../../index.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" name="submit" class="btn btn-primary">Save Student</button>
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