<?php 
include 'checker.php';
include_once './connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["position"])) {
        $candidateposition = $_SESSION['candidatePosition'];
        $position = ucwords(strtolower(trim($_POST["position"])));

        $sql = "INSERT INTO `$candidateposition` (Position) 
        VALUES ('$position')";

        if ($conn->query($sql) === TRUE) {

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

                    $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Added new position named $position.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                    mysqli_query($conn, $sql_reports);
                }
            }
            
            header("Location: ../index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>