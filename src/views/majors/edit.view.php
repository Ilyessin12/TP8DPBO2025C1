<?php
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/../../controllers/Major.controller.php");

// Initialize controller
$majorController = new MajorController();

$id = $majorCode = $majorName = "";
$error = "";

// Set base URL for header
$baseUrl = "../../";

// Page title
$pageTitle = "Edit Major";

// Check if ID is provided in URL
if(!isset($_GET['id'])){
    $_SESSION['error'] = "No major ID provided";
    header("Location: major.view.php");
    exit;
}

$id = $_GET['id'];
$major = $majorController->getMajorById($id);

// Check if major exists
if(!$major){
    $_SESSION['error'] = "Major not found";
    header("Location: major.view.php");
    exit;
}

// Get major data
$majorCode = $major->getMajorCode();
$majorName = $major->getMajorName();

// Process form submission
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $majorCode = $_POST['major_code'];
    $majorName = $_POST['major_name'];
    
    try{
        if($majorController->updateMajor($id, $majorCode, $majorName)){
            $_SESSION['success'] = "Major updated successfully";
            header("Location: major.view.php");
            exit;
        }
        else{
            $error = "Failed to update major";
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
                <h4 class="mb-0">Edit Major</h4>
            </div>
            <div class="card-body">
                <?php if(!empty($error)){ ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    
                    <div class="mb-3">
                        <label for="major_code" class="form-label">Major Code</label>
                        <input type="text" class="form-control" id="major_code" name="major_code" value="<?php echo $majorCode; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="major_name" class="form-label">Major Name</label>
                        <input type="text" class="form-control" id="major_name" name="major_name" value="<?php echo $majorName; ?>" required>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="major.view.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" name="submit" class="btn btn-warning">Update Major</button>
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
