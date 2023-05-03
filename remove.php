<?php
include 'config/database.php';
if (isset($_GET['feedbackId'])) {
  $id = $_GET['feedbackId'];
  $sql = "DELETE FROM feedback WHERE id=$id";
  $res = mysqli_query($conn, $sql);
  if ($res) {
    header('location: feedback.php');
  } else {
    die('Delete feedback Failed ' . $conn->connect_error);
  }
}
