<?php
//include 'config.php';
include 'checker.php';
include_once 'connection.php';

if (isset($_GET['id'])) {
    $Id = $_GET['id'];
    
    $candidateposition = $_SESSION['candidatePosition'];

    $sql_select = "SELECT * FROM `$candidateposition` WHERE id='$Id'";
    $result_select = $conn->query($sql_select);
    if ($result_select->num_rows > 0) {
        $row_select = $result_select->fetch_assoc();
        $position = $row_select["position"];

        $adminpassword = $_SESSION['Logged_in_Admin'];
        $sql_insertReports = "SELECT * FROM `lsc_election_list` WHERE status = 'activated'";
        $result_insertReports = $conn->query($sql_insertReports);
        if ($result_insertReports->num_rows > 0) {
            $row = $result_insertReports->fetch_assoc();
            $audittrial_reportbatch = $row["audittrial_report"];

            $sql_Adminreports = "SELECT * FROM `admins` WHERE password_admin = '$adminpassword'";
            $result_Adminreports = $conn->query($sql_Adminreports);
            if ($result_Adminreports->num_rows > 0) {
                $rowadmin = $result_Adminreports->fetch_assoc();
                $admin = $rowadmin["username_admin"];

                date_default_timezone_set('Asia/Manila');
                $currentHour = date("H");
                $isAfternoonOrEvening = $currentHour >= 12;
                $currentTime12Hour = date("g:i") . ($isAfternoonOrEvening ? ' PM' : ' AM');
                $currentDateFormatted = date("m-d-Y");

                $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Position $position has been removed.','$admin','$currentDateFormatted/$currentTime12Hour')";
                mysqli_query($conn, $sql_reports);
            }
        }
    }

    $sql = "DELETE FROM `$candidateposition` WHERE id ='$Id'";
    mysqli_query($conn, $sql);
}

exit();
?>