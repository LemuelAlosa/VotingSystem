<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

function getAdminStatus($conn) {
    $sql = "SELECT `status` FROM `admins` LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row['status'];
        // Check the status and echo the appropriate response
        if ($status == 'activated') {
            echo 'activated';
        } elseif ($status == 'deactivated') {
            echo 'deactivated';
        } else {
            echo 'none';
        }
    } else {
        echo 'none';
    }
}

getAdminStatus($conn);
?>