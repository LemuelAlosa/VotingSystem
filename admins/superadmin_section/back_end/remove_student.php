<?php
//include 'config.php';
include 'checker.php';
include_once 'connection.php';

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    if(isset($_SESSION['Batch'])){
        $currentBatch = $_SESSION['currentBatch'];
        $sql_select = "SELECT * FROM `students_batch$defaultBatch` WHERE student_number='$studentId'";
    }else{
        $defaultBatch = $_SESSION['defaultBatch'];
        $sql_select = "SELECT * FROM `students_batch$defaultBatch` WHERE student_number='$studentId'";
    }
    $result_select = $conn->query($sql_select);
    if ($result_select->num_rows > 0) {
        $row_select = $result_select->fetch_assoc();
        $student_id = $row_select["student_id"];
        $Fname = $row_select["Fname"];
        $Lname = $row_select["Lname"];

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

                $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Student $student_id / $Fname $Lname has been removed.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                mysqli_query($conn, $sql_reports);
            }
        }
    }
    
    if(isset($_SESSION['Batch'])){
        $currentBatch = $_SESSION['currentBatch'];
        $sql = "DELETE FROM `students_batch$currentBatch` WHERE student_number='$studentId'";
    }else{
        $defaultBatch = $_SESSION['defaultBatch'];
        $sql = "DELETE FROM `students_batch$defaultBatch` WHERE student_number='$studentId'";
    }
    mysqli_query($conn, $sql);
    
}

header("Location: ../index.php");
exit();
?>