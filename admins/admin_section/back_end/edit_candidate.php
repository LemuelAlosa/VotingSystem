<?php
//include 'config.php';
include 'checker.php';
include_once 'connection.php';

if (isset($_GET['id'])) {
    $candidateId = $_GET['id'];

    $Batch = $_SESSION['CandidateBatch'];

    $sql = "SELECT * FROM `$Batch` WHERE id='$candidateId'";
    $result = $conn->query($sql);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Ensure that the form fields are not empty
        if (isset($_POST["position"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["yearlevel"]) && isset($_POST["course"]) && isset($_POST["gender"]) && isset($_POST["missionstatement"])) {

            // Retrieve the form data
            $position = $_POST["position"];
            $partylist = $_POST["partylist"];
            $firstname = ucwords(strtolower(trim($_POST["firstname"])));
            $middlename = ucwords(strtolower(trim($_POST["middlename"])));
            $lastname = strtoupper($_POST["lastname"]);
            $Suffix = strtolower(trim(str_replace('.', '', $_POST["suffix"])));
            $yearlevel = $_POST["yearlevel"];
            $course = $_POST["course"];
            $gender = $_POST["gender"];
            $missionstatement = mysqli_real_escape_string($conn, ucfirst($_POST["missionstatement"]));

            // Check if a new image is uploaded
            if (isset($_FILES["imagescandidates"]) && $_FILES["imagescandidates"]["size"] > 0) {
                $imagecandidatefilename = $_FILES["imagescandidates"]["name"];

                $targetDir = "../candidates_images/"; // Directory where you want to store the uploaded files

                // Create the target directory if it doesn't exist
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                $targetFile = $targetDir . basename($imagecandidatefilename);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Allow only specific file formats (optional)
                if (!in_array($imageFileType, array("jpg", "jpeg", "png"))) {
                    echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk === 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["imagescandidates"]["tmp_name"], $targetFile)) {
                        // Update the database with the new image filename
                        $sql = "UPDATE `$Batch` SET Position='$position', Partylist='$partylist', Firstname_candidate='$firstname', Middlename_candidate='$middlename', Lastname_candidate='$lastname', suffix='$Suffix', Yearlevel='$yearlevel', Course='$course', Gender='$gender', Image='$imagecandidatefilename', Mission='$missionstatement' WHERE id='$candidateId'";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                // No new image uploaded, update without changing the image filename
                $sql = "UPDATE `$Batch` SET Position='$position', Partylist='$partylist', Firstname_candidate='$firstname', Middlename_candidate='$middlename', Lastname_candidate='$lastname', suffix='$Suffix', Yearlevel='$yearlevel', Course='$course', Gender='$gender', Mission='$missionstatement' WHERE id='$candidateId'";
            }

            if ($conn->query($sql) === TRUE) {

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

                        $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Candidate $firstname $lastname was edited.','$admin','$currentDateFormatted/$currentTime12Hour')";
                        mysqli_query($conn, $sql_reports);
                    }
                }

                header("Location: ../index.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // Form fields are not complete
            echo "Please fill in all required fields.";
        }
    }
}
?>