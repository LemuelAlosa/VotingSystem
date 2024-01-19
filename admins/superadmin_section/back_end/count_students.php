<?php
include 'connection.php';

if(isset($_SESSION['Batch'])){
    $currentBatch = $_SESSION['currentBatch'];
    $sql_voters = "SELECT COUNT(*) AS total_voters FROM `students_batch$currentBatch`";
}else{
    $defaultBatch = $_SESSION['defaultBatch'];
    $sql_voters = "SELECT COUNT(*) AS total_voters FROM `students_batch$defaultBatch`";
}
$result1 = $conn->query($sql_voters);
$totalVoters = '0';
if ($result1->num_rows > 0) {
    // Kunin ang resulta ng query
    $row = $result1->fetch_assoc();
    $totalVoters = $row["total_voters"];
}

if(isset($_SESSION['Batch'])){
    $currentBatch = $_SESSION['currentBatch'];
    $sql_voted = "SELECT COUNT(*) AS total_voted FROM `students_batch$currentBatch` WHERE status = 'voted'";
}else{
    $defaultBatch = $_SESSION['defaultBatch'];
    $sql_voted = "SELECT COUNT(*) AS total_voted FROM `students_batch$defaultBatch` WHERE status = 'voted'";
}
$result2 = $conn->query($sql_voted);
$totalVoted = '0';
if ($result2->num_rows > 0) {
    // Kunin ang resulta ng query
    $row = $result2->fetch_assoc();
    $totalVoted = $row["total_voted"];
}


if(isset($_SESSION['Batch'])){
    $currentBatch = $_SESSION['currentBatch'];
    $sql_unvoted = "SELECT COUNT(*) AS total_unvoted FROM `students_batch$currentBatch` WHERE status = 'unvoted'";
}else{
    $defaultBatch = $_SESSION['defaultBatch'];
    $sql_unvoted = "SELECT COUNT(*) AS total_unvoted FROM `students_batch$defaultBatch` WHERE status = 'unvoted'";
}
$result3 = $conn->query($sql_unvoted);
$totalUnvoted = '0';
if ($result3->num_rows > 0) {
    // Kunin ang resulta ng query
    $row = $result3->fetch_assoc();
    $totalUnvoted = $row["total_unvoted"];
}
?>