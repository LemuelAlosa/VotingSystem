<?php
include './connection.php';
session_start();

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

        $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Logout','$admin','$currentDateFormatted/$currentTime12Hour')";
        mysqli_query($conn, $sql_reports);
    }
}

session_unset();
session_destroy();

header("Location: ../../index.php");
exit();
?>