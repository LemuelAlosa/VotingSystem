<?php
//include 'config.php';
include 'checker.php';
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // $Batch = $_SESSION['CandidateBatch'];
    $candidatepartylist = $_SESSION['candidatePartylist'];

    // $sql_search = "SELECT * FROM `$candidatepartylist` WHERE id = '$id'";
    // $result = $conn->query($sql_search);

    // if ($result->num_rows > 0) {
    //     $rowstored = $result->fetch_assoc();
    //     $partylistteam = $rowstored["partylist"];

    //     $sql_search1 = "SELECT * FROM `$Batch` WHERE Partylist = '$partylistteam'";
    //     $result = $conn->query($sql_search1);

    //     if ($result->num_rows > 0) {
    //         $rowstored1 = $result->fetch_assoc();
    //         $partylistname = $rowstored1["Partylist"];

    //         $sql_Update = "UPDATE `$Batch` SET Partylist = 'None' WHERE Partylist = '$partylistname'";

    //         if (mysqli_query($conn, $sql_Update)) {
    //             echo "Update successful!";
    //         } else {
    //             echo "Error updating record: " . mysqli_error($conn);
    //         }
    //     }
    // } else {
    //     echo "No records found with ID: $id";
    // }

    $sql_select = "SELECT * FROM `$candidatepartylist` WHERE id='$id'";
    $result_select = $conn->query($sql_select);
    if ($result_select->num_rows > 0) {
        $row_select = $result_select->fetch_assoc();
        $partylist = $row_select["partylist"];

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

                $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Partylist $partylist has been removed.','$admin','$currentDateFormatted/$currentTime12Hour')";
                mysqli_query($conn, $sql_reports);
            }
        }
    }

    $sql = "DELETE FROM `$candidatepartylist` WHERE id ='$id'";
    mysqli_query($conn, $sql);
}

exit();
?>