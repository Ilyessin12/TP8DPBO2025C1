<?php
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/../../controllers/Major.controller.php");

// Initialize controller
$majorController = new MajorController();

$error = '';

// Set base URL for header
$baseUrl = "../../";

// Page title
$pageTitle = "Add New Major";

// Process form submission
if(isset($_POST['submit'])){
    $majorCode = $_POST['major_code'];
    $majorName = $_POST['major_name'];
    
    try{
        if($majorController->addMajor($majorCode, $majorName)){
            $_SESSION['success'] = "Major added successfully";
            header("Location: major.view.php"); // Redirect to major list
            exit;
        }
        else{
            $error = "Failed to add major";
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
                <h4 class="mb-0">Add New Major</h4>
            </div>
            <div class="card-body">
                <?php if(!empty($error)){ ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="major_code" class="form-label">Major Code</label>
                        <input type="text" class="form-control" id="major_code" name="major_code" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="major_name" class="form-label">Major Name</label>
                        <input type="text" class="form-control" id="major_name" name="major_name" required>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="major.view.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" name="submit" class="btn btn-primary">Save Major</button>
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
