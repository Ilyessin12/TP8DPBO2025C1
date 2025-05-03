<?php
include "connection.php";
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $nim = $_POST['nim'];
  $phone = $_POST['phone'];
  $join_date = $_POST['join_date'];
  $q = " INSERT INTO `students`(`name`, `nim`, `phone`, `join_date`) VALUES ( '$name', '$nim', '$phone', '$join_date' )";

  $query = mysqli_query($conn, $q);
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Tambah</title>

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

        <div class="card-header bg-primary">
          <h1 class="text-white text-center"> Create Student</h1>
        </div><br>

        <label> NAME: </label>
        <input type="text" name="name" class="form-control" required> <br>

        <label> NIM: </label>
        <input type="text" name="nim" class="form-control" required> <br>

        <label> PHONE: </label>
        <input type="text" name="phone" class="form-control" required> <br>

        <label> JOIN DATE: </label>
        <input type="date" name="join_date" class="form-control" required> <br>

        <button class="btn btn-success" type="submit" name="submit">Submit </button><br>
        <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

      </div>
    </form>
  </div>
</body>

</html>