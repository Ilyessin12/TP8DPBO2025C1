<?php
include "connection.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE from `students` where id=$id";
    $conn->query($sql);
}
header('location:/bakekok/index.php');
exit;
