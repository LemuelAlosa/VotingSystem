<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['electionname']) && $_POST['datecreation'] != "" && isset($_POST['electiondetails'])) {

        $electionname = $_POST["electionname"];
        $datecreation = $_POST["datecreation"];
        $electiondetails = $_POST["electiondetails"];

        $electionnamedate = substr($electionname, 8);
        $candidate_batch = "candidate_batch$electionnamedate";
        $students_batch = "students_batch$electionnamedate";
        $candidate_position = "candidate_position$electionnamedate";
        $candidate_partylist = "candidate_partylist$electionnamedate";
        $auditrialreport = "audittrial_report$electionnamedate";


        $sql_update = "UPDATE lsc_election_list SET status = 'deactivated' WHERE status = 'activated'";
        mysqli_query($conn, $sql_update);

        // SQL query para sa pag-insert ng record sa 'lsc_election_list'
        $sql = "INSERT INTO lsc_election_list (lscbatch_list, date, electiondetails, candidate_batch, students_batch, candidate_position, candidate_partylist, audittrial_report, status)
         VALUES ('$electionname','$datecreation','$electiondetails','$candidate_batch','$students_batch','$candidate_position','$candidate_partylist', '$auditrialreport','activated')";

        if ($conn->query($sql) === TRUE) {

            // SQL query para sa paggawa ng table 'candidate_batch$electionnamedate'
            $createTableCandidateSQL = "CREATE TABLE IF NOT EXISTS `candidate_batch$electionnamedate` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `Position` varchar(250) NOT NULL,
                `Partylist` varchar(250) NOT NULL,
                `Firstname_candidate` varchar(250) NOT NULL,
                `Middlename_candidate` varchar(250) NOT NULL,
                `Lastname_candidate` varchar(250) NOT NULL,
                `Yearlevel` varchar(250) NOT NULL,
                `Course` varchar(250) NOT NULL,
                `Gender` varchar(250) NOT NULL,
                `Image` varchar(250) NOT NULL,
                `Mission` varchar(250) NOT NULL,
                `suffix` varchar(250) NOT NULL,
                `votes` int(11) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            // SQL query para sa paggawa ng table 'students_batch$electionnamedate'
            $createTableStudentsSQL = "CREATE TABLE IF NOT EXISTS `students_batch$electionnamedate` (
                `student_number` int(11) NOT NULL AUTO_INCREMENT,
                `student_id` varchar(250) NOT NULL,
                `password_student` varchar(250) NOT NULL,
                `cysg` varchar(250) NOT NULL,
                `status` varchar(250) NOT NULL,
                `account` varchar(250) NOT NULL,
                `email_address` varchar(250) NOT NULL,
                `Fname` varchar(250) NOT NULL,
                `Lname` varchar(250) NOT NULL,
                `Mname` varchar(250) NOT NULL,
                `suffix` varchar(250) NOT NULL,
                `sendpass` varchar(250) NOT NULL,
                PRIMARY KEY (`student_number`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $createTableCandidatePosition = "CREATE TABLE IF NOT EXISTS `candidate_position$electionnamedate` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `position` varchar(250) NOT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $createTableCandidatePartylist = "CREATE TABLE IF NOT EXISTS `candidate_partylist$electionnamedate` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `partylist` varchar(250) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $createTableAuditTrailReports = "CREATE TABLE IF NOT EXISTS `audittrial_report$electionnamedate` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `reports` varchar(250) NOT NULL,
                `account` varchar(250) NOT NULL,
                `date/time` varchar(250) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            if (
                $conn->query($createTableCandidateSQL) === TRUE && $conn->query($createTableStudentsSQL) === TRUE
                && $conn->query($createTableAuditTrailReports) === TRUE && $conn->query($createTableCandidatePosition) === TRUE
                && $conn->query($createTableCandidatePartylist) === TRUE
            ) {

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

                        $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('New $electionname has been created.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                        mysqli_query($conn, $sql_reports);
                    }
                }

                header("Location: ../index.php");
            } else {
                echo "Error creating tables: " . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
header("Location: ../index.php");
exit();
?>