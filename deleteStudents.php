<?php
include("config.php");

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

header("Location:studentList.php");
?>
