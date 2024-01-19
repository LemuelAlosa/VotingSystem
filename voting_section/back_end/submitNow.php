<?php 
include_once 'checker.php';
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which radio buttons were selected
    if (isset($_POST['choices1'])) {
        $_SESSION['Choice1'] = $_POST['choices1'];
    }
    if (isset($_POST['choices2'])) {
        $_SESSION['Choice2'] = $_POST['choices2'];
    }
    if (isset($_POST['choices3'])) {
        $_SESSION['Choice3'] = $_POST['choices3'];
    }
    if (isset($_POST['choices4'])) {
        $_SESSION['Choice4'] = $_POST['choices4'];
    }
    if (isset($_POST['choices5'])) {
        $_SESSION['Choice5'] = $_POST['choices5'];
    }
    if (isset($_POST['choices6'])) {
        $_SESSION['Choice6'] = $_POST['choices6'];
    }
    if (isset($_POST['choices8'])) {
        $_SESSION['Choice8'] = $_POST['choices8'];
    }
    if (isset($_POST['choices9'])) {
        $_SESSION['Choice9'] = $_POST['choices9'];
    }
    if (isset($_POST['choices10'])) {
        $_SESSION['Choice10'] = $_POST['choices10'];
    }
    if (isset($_POST['choices11'])) {
        $_SESSION['Choice11'] = $_POST['choices11'];
    }
    if (isset($_POST['choices12'])) {
        $_SESSION['Choice12'] = $_POST['choices12'];
    }
    if (isset($_POST['choices13'])) {
        $_SESSION['Choice13'] = $_POST['choices13'];
    }
    if (isset($_POST['choices14'])) {
        $_SESSION['Choice14'] = $_POST['choices14'];
    }
    if (isset($_POST['choices15'])) {
        $_SESSION['Choice15'] = $_POST['choices15'];
    }

    $sql = "SELECT * FROM `lsc_election_list` WHERE status = 'activated'";
    $resultDB = $conn->query($sql);

    // Check if a row was returned from 'admins' table
    if ($resultDB->num_rows === 1) {
        $rowDB = $resultDB->fetch_assoc();
        $candidatestoredbatch = $rowDB["candidate_batch"];
        // $votedstoredbatch = $rowDB["votedlist_batch"];
        $studentstoredbatch = $rowDB["students_batch"];

        $Studentpassword = $_SESSION['Logged_in'];
        $sql_update = "UPDATE `$studentstoredbatch` SET status='voted' WHERE password_student='$Studentpassword'";

        if ($conn->query($sql_update) === TRUE) {

            $sql_student = "SELECT * FROM `$studentstoredbatch` WHERE password_student='$Studentpassword'";
            $result = $conn->query($sql_student);

            // Check if a row was returned from 'admins' table
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $cysg = $row["cysg"];
                $student_id = $row["student_id"]; 

                if(isset($_SESSION['Choice1'])){
                    $Choice = $_SESSION['Choice1'];
                    $sql_votes = "SELECT votes FROM `$candidatestoredbatch` WHERE id = '$Choice'";
                    $result = $conn->query($sql_votes);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $currentVotes = $row['votes'];

                        // Increment the value
                        $newVotes = $currentVotes + 1;

                        // Update the database with the incremented value
                        $sql_newvotes = "UPDATE `$candidatestoredbatch` SET votes = $newVotes WHERE id = '$Choice'";
                        if ($conn->query($sql_newvotes) === TRUE) {
                            //echo "Record updated successfully.";
                        } else {
                            //echo "Error updating record: " . $conn->error;
                        }
                    }
                }

                if(isset($_SESSION['Choice2'])){
                    $Choice = $_SESSION['Choice2'];
                    $sql_votes = "SELECT votes FROM `$candidatestoredbatch` WHERE id = '$Choice'";
                    $result = $conn->query($sql_votes);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $currentVotes = $row['votes'];

                        // Increment the value
                        $newVotes = $currentVotes + 1;

                        // Update the database with the incremented value
                        $sql_newvotes = "UPDATE `$candidatestoredbatch` SET votes = $newVotes WHERE id = '$Choice'";
                        if ($conn->query($sql_newvotes) === TRUE) {
                            //echo "Record updated successfully.";
                        } else {
                            //echo "Error updating record: " . $conn->error;
                        }
                    }
                }
                
                if(isset($_SESSION['Choice3'])){
                    $Choice = $_SESSION['Choice3'];
                    $sql_votes = "SELECT votes FROM `$candidatestoredbatch` WHERE id = '$Choice'";
                    $result = $conn->query($sql_votes);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $currentVotes = $row['votes'];

                        // Increment the value
                        $newVotes = $currentVotes + 1;

                        // Update the database with the incremented value
                        $sql_newvotes = "UPDATE `$candidatestoredbatch` SET votes = $newVotes WHERE id = '$Choice'";
                        if ($conn->query($sql_newvotes) === TRUE) {
                            //echo "Record updated successfully.";
                        } else {
                            //echo "Error updating record: " . $conn->error;
                        }
                    }
                }

                if(isset($_SESSION['Choice4'])){
                    $Choice = $_SESSION['Choice4'];
                    $sql_votes = "SELECT votes FROM `$candidatestoredbatch` WHERE id = '$Choice'";
                    $result = $conn->query($sql_votes);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $currentVotes = $row['votes'];

                        // Increment the value
                        $newVotes = $currentVotes + 1;

                        // Update the database with the incremented value
                        $sql_newvotes = "UPDATE `$candidatestoredbatch` SET votes = $newVotes WHERE id = '$Choice'";
                        if ($conn->query($sql_newvotes) === TRUE) {
                            //echo "Record updated successfully.";
                        } else {
                            //echo "Error updating record: " . $conn->error;
                        }
                    }
                }
            }
            
            session_unset();
            session_destroy();
            echo "<script>window.location.href = '../../index.php';</script>";

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        

    }

    
}

?>