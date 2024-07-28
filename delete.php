<?php
include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM participants WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="index.php">Go Back</a>
