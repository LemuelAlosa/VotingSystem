<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

function generateRandomPassword($length = 7)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $characterCount = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $characterCount - 1);
        $password .= $characters[$index];
    }

    return $password;
}

// Password is correct
if (isset($_SESSION['Batch'])) {
    $currentBatch = $_SESSION['currentBatch'];
    $sql_random_password = "SELECT student_number FROM `students_batch$currentBatch`";
} else {
    $defaultBatch = $_SESSION['defaultBatch'];
    $sql_random_password = "SELECT student_number FROM `students_batch$defaultBatch`";
}
$result1 = $conn->query($sql_random_password);

if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $studentNumber = $row['student_number'];
        $randompass = generateRandomPassword();
        $randompasspart1 = substr($randompass, 0, 4);
        $randompasspart2 = substr($randompass, 4, 3);
        $generateRandomPassword = hash('sha256', $Salt . $randompass . $Pepper);
        $randomPassword = substr_replace($generateRandomPassword, $randompasspart1, 11, 0);
        $randomPassword = substr_replace($randomPassword, $randompasspart2, 19, 0);

        // Construct the individual update query for each student
        if (isset($_SESSION['Batch'])) {
            $currentBatch = $_SESSION['currentBatch'];
            $sqlUpdate = "UPDATE `students_batch$currentBatch` SET password_student = '$randomPassword' WHERE student_number = '$studentNumber'";
        } else {
            $defaultBatch = $_SESSION['defaultBatch'];
            $sqlUpdate = "UPDATE `students_batch$defaultBatch` SET password_student = '$randomPassword' WHERE student_number = '$studentNumber'";
        }
        $resultUpdate = $conn->query($sqlUpdate);
    }
}

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

        $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('All student has been generated their own new randomize passwords.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
        mysqli_query($conn, $sql_reports);
    }
}

echo '<script>window.location.href = "../index.php";</script>';
exit();