<?php
include 'checker.php';
include_once './connection.php';

$candidateposition = $_SESSION['candidatePosition'];

$sql = "SELECT * FROM `$candidateposition`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Password is correct
} else {
    echo 'NoPosition';
}

exit();