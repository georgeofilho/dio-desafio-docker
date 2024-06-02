<?php
include('includes/db.php');

$id = $_GET['id'];

$sql = "DELETE FROM mercadoria WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header('Location: dashboard.php');
} else {
    $error = "Error: " . $sql . "<br>" . $conn->error;
}
?>
