<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

if(isset($_SESSION['Batch'])){
    $currentBatch = $_SESSION['currentBatch'];
    $sqlUpdateStudents = "UPDATE `students_batch$currentBatch` SET account = 'deactivated'";
}else{
    $defaultBatch = $_SESSION['defaultBatch'];
    $sqlUpdateStudents = "UPDATE `students_batch$defaultBatch` SET account = 'deactivated'";
}
$resultUpdateStudents = $conn->query($sqlUpdateStudents);

if ($resultUpdateStudents === TRUE) {

    $superadminpassword = $_SESSION['Logged_in_Superadmin'];
    $sql_insertReports = "SELECT * FROM `lsc_election_list` WHERE status = 'activated'";
    $result_insertReports = $conn->query($sql_insertReports);
    if ($result_insertReports->num_rows > 0) {
        $row = $result_insertReports->fetch_assoc();
        $audittrial_reportbatch = $row["audittrial_report"];

        $sql_Superadminreports = "SELECT * FROM `super_admin` WHERE password_superadmin = '$superadminpassword'";
        $result_Superadminreports = $conn->query($sql_Superadminreports);
        if ($result_Superadminreports->num_rows > 0) {
            $rowsuperadmin = $result_Superadminreports->fetch_assoc();
            $superadmin = $rowsuperadmin["username_superadmin"];

            date_default_timezone_set('Asia/Manila');
            $currentHour = date("H");
            $isAfternoonOrEvening = $currentHour >= 12;
            $currentTime12Hour = date("g:i") . ($isAfternoonOrEvening ? ' PM' : ' AM');
            $currentDateFormatted = date("m-d-Y");

            $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Deactivated all the students','$superadmin','$currentDateFormatted/$currentTime12Hour')";
            mysqli_query($conn, $sql_reports);
        }
    }

    header("Location: ../index.php");
} else {
    echo "Error updating admin status: " . $conn->error;
}
exit();
?>
