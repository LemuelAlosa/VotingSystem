<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

function getSuperadminStatus($conn) {
    $sql = "SELECT `status` FROM `super_admin` WHERE status = 'activated' OR status = 'deactivated'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $acountstatus = $row['status'];
        // Check the status and echo the appropriate response
        if ($acountstatus == 'activated') {
            echo 'activated';
        } elseif ($acountstatus == 'deactivated') {
            echo 'deactivated';
        } else {
            echo 'none';
        }
    } else {
        echo 'none';
    }
}

getSuperadminStatus($conn);
?>
