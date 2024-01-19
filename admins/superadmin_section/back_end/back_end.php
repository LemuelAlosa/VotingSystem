<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure that the form fields are not empty
    if (isset($_POST["position"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["yearlevel"]) && isset($_POST["course"]) && isset($_POST["gender"]) && isset($_POST["missionstatement"]) && isset($_FILES["imagescandidates"])) {

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
        $imagecandidatefilename = $_FILES["imagescandidates"]["name"];

        $targetDir = "../admin_section/candidates_images/"; // Directory where you want to store the uploaded files

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

        $Batch = $_SESSION['CandidateBatch'];

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk === 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["imagescandidates"]["tmp_name"], $targetFile)) {
                $sql = "INSERT INTO `$Batch` (Position, Partylist, Firstname_candidate, Middlename_candidate, Lastname_candidate, suffix, Yearlevel, Course, Gender, Image, Mission) 
                        VALUES ('$position', '$partylist', '$firstname', '$middlename', '$lastname', '$Suffix', '$yearlevel', '$course', '$gender', '$imagecandidatefilename', '$missionstatement')";
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

                            $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Added new candidate named $firstname $lastname as $position.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                            mysqli_query($conn, $sql_reports);
                        }
                    }

                    header("Location: ../index.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Form fields are not complete
        echo "Please fill in all required fields.";
    }
}
?>