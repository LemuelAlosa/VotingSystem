<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

if (isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $studentId = $_GET['id'];

    // Ensure that the form fields are not empty
    if (isset($_POST["student_id"]) && isset($_POST["cysg"]) && isset($_POST["firstname"]) && isset($_POST["lastname"])) {
        $student_id = $_POST["student_id"];
        $Fname = $_POST["firstname"];
        $Lname = $_POST["lastname"];
        $Mname = $_POST["middlename"];
        $cysg = $_POST["cysg"];
        $emailaddress = $_POST["emailaddress"];
        $Suffix = $_POST["Suffix"];
        $Suffix = strtolower($Suffix);

        if (isset($_SESSION['Batch'])) {
            $currentBatch = $_SESSION['currentBatch'];
            $sql_update = "UPDATE `students_batch$currentBatch` SET student_id = '$student_id', Fname = '$Fname', Lname = '$Lname', Mname = '$Mname', cysg = '$cysg', email_address = '$emailaddress', suffix = '$Suffix' WHERE student_number = $studentId";
        } else {
            $defaultBatch = $_SESSION['defaultBatch'];
            $sql_update = "UPDATE `students_batch$defaultBatch` SET student_id = '$student_id', Fname = '$Fname', Lname = '$Lname', Mname = '$Mname', cysg = '$cysg', email_address = '$emailaddress', suffix = '$Suffix' WHERE student_number = $studentId";
        }

        // Execute the update query
        if ($conn->query($sql_update) === TRUE) {

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

                    $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Student $student_id / $Fname $Lname was edited.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                    mysqli_query($conn, $sql_reports);
                }
            }

            header("Location: ../index.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
?>