<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

function getStudentAccount($conn) {
    if(isset($_SESSION['Batch'])){
        $currentBatch = $_SESSION['currentBatch'];
        $sql = "SELECT `account` FROM `students_batch$currentBatch` LIMIT 1";
    }else{
        $defaultBatch = $_SESSION['defaultBatch'];
        $sql = "SELECT `account` FROM `students_batch$defaultBatch` LIMIT 1";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $account = $row['account'];
        // Check the status and echo the appropriate response
        if ($account == 'activated') {
            echo 'activated';
        } elseif ($account == 'deactivated') {
            echo 'deactivated';
        } else {
            echo 'unknown';
        }
    } else {
        echo 'unknown';
    }
}

getStudentAccount($conn);
?>