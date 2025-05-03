<?php
include "connection.php";
$id = "";
$name = "";
$nim = "";
$phone = "";
$join_date = "";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
  if (!isset($_GET['id'])) {
    header("location:crud100/index.php");
    exit;
  }
  $id = $_GET['id'];
  $sql = "select * from students where id=$id";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  while (!$row) {
    header("location: crud100/index.php");
    exit;
  }
  $name = $row["name"];
  $nim = $row["nim"];
  $phone = $row["phone"];
  $join_date = $row["join_date"];
} else {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $nim = $_POST["nim"];
  $phone = $_POST["phone"];
  $join_date = $_POST["join_date"];

  $sql = "update students set name='$name', nim='$nim', phone='$phone', join_date='$join_date' where id='$id'";
  $result = $conn->query($sql);
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Ubah</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="popper.min.js"></script>
  <script src="bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Students</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">?</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="col-lg-6 m-auto">

    <form method="post">

      <br><br>
      <div class="card">

        <div class="card-header bg-warning">
          <h1 class="text-white text-center"> Update Student </h1>
        </div><br>

        <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> <br>

        <label> NAME: </label>
        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control"> <br>

        <label> NIM: </label>
        <input type="text" name="nim" value="<?php echo $nim; ?>" class="form-control"> <br>

        <label> PHONE: </label>
        <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control"> <br>

        <label> JOIN DATE: </label>
        <input type="date" name="join_date" value="<?php echo $join_date; ?>" class="form-control"> <br>

        <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
        <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

      </div>
    </form>
  </div>
</body>

</html>