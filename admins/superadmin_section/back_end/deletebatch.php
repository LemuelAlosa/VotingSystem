<?php
//include 'config.php';
include 'checker.php';
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION['Batch'])) {
        $currentBatch = $_SESSION['currentBatch'];

        $sql_1 = "DELETE FROM lsc_election_list WHERE status = 'activated'";
        $sql_2 = "UPDATE lsc_election_list SET status = 'activated' ORDER BY lscbatch_id DESC LIMIT 1";
        $sql_3 = "DROP TABLE `candidate_batch$currentBatch`";
        $sql_4 = "DROP TABLE `students_batch$currentBatch`";
        $sql_5 = "DROP TABLE `audittrial_report$currentBatch`";
        $sql_6 = "DROP TABLE `candidate_position$currentBatch`";
        $sql_7 = "DROP TABLE `candidate_partylist$currentBatch`";

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

                $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('LSCBatch$currentBatch has been deleted.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                mysqli_query($conn, $sql_reports);
            }
        }

        mysqli_query($conn, $sql_1);
        mysqli_query($conn, $sql_2);
        mysqli_query($conn, $sql_3);
        mysqli_query($conn, $sql_4);
        mysqli_query($conn, $sql_5);
        mysqli_query($conn, $sql_6);
        mysqli_query($conn, $sql_7);

        unset($_SESSION['Batch']);
        unset($_SESSION['currentBatch']);        

        echo '<script>window.location.href = "../index.php";</script>';
    } else {
        $defaultBatch = $_SESSION['defaultBatch'];

        $sql_1 = "DELETE FROM lsc_election_list WHERE status = 'activated'";
        $sql_2 = "UPDATE lsc_election_list SET status = 'activated' ORDER BY lscbatch_id DESC LIMIT 1";
        $sql_3 = "DROP TABLE `candidate_batch$defaultBatch`";
        $sql_4 = "DROP TABLE `students_batch$defaultBatch`";
        $sql_5 = "DROP TABLE `audittrial_report$defaultBatch`";
        $sql_6 = "DROP TABLE `candidate_position$defaultBatch`";
        $sql_7 = "DROP TABLE `candidate_partylist$defaultBatch`";

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

                $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('LSCBatch$defaultBatch has been deleted.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                mysqli_query($conn, $sql_reports);
            }
        }

        mysqli_query($conn, $sql_1);
        mysqli_query($conn, $sql_2);
        mysqli_query($conn, $sql_3);
        mysqli_query($conn, $sql_4);
        mysqli_query($conn, $sql_5);
        mysqli_query($conn, $sql_6);
        mysqli_query($conn, $sql_7);

        function getBatchYear($conn)
        {
            $sql = "SELECT * FROM lsc_election_list ORDER BY lscbatch_id DESC LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $lscbatch_list = $row['lscbatch_list'];

                    if (preg_match('/\d{4}-\d{4}/', $lscbatch_list, $matches)) {
                        return $matches[0];
                    }
                }
            }

            return "";
        }

        $_SESSION['defaultBatch'] = getBatchYear($conn);

        if (getBatchYear($conn)) {
            echo '<script>window.location.href = "../index.php";</script>';
        }

    }
}

exit();
?>