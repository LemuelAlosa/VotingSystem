<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $studentId = $_GET['id'];

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

                    $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Student $student_id / $Fname $Lname was generate a new password and resend it on email.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                    mysqli_query($conn, $sql_reports);
                }
            }

            echo 'SUCCESS';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

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

    $randompass = generateRandomPassword();
    $randompasspart1 = substr($randompass, 0, 4);
    $randompasspart2 = substr($randompass, 4, 3);
    $generateRandomPassword = hash('sha256', $Salt . $randompass . $Pepper);
    $randomPassword = substr_replace($generateRandomPassword, $randompasspart1, 11, 0);
    $randomPassword = substr_replace($randomPassword, $randompasspart2, 19, 0);

    if (isset($_SESSION['Batch'])) {
        $currentBatch = $_SESSION['currentBatch'];
        $sql_updatepass = "UPDATE `students_batch$currentBatch` SET password_student = '$randomPassword' WHERE student_number = $studentId";
    } else {
        $defaultBatch = $_SESSION['defaultBatch'];
        $sql_updatepass = "UPDATE `students_batch$defaultBatch` SET password_student = '$randomPassword' WHERE student_number = $studentId";
    }

    // Execute the update query
    if ($conn->query($sql_updatepass) === TRUE) {
        echo 'SUCCESS';
    } else {
        echo "Error updating record: " . $conn->error;
    }

    if (isset($_SESSION['Batch'])) {
        $currentBatch = $_SESSION['currentBatch'];
        $sql = "SELECT * FROM `students_batch$currentBatch` WHERE student_number = $studentId";
    } else {
        $defaultBatch = $_SESSION['defaultBatch'];
        $sql = "SELECT * FROM `students_batch$defaultBatch` WHERE student_number = $studentId";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Username = 'bsuhagonoy.lsc.onlinevoting@gmail.com';
        $mail->Password = 'ccfunhzdsivqjsbo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('bsuhagonoy-campus-voice@gmail.com', 'Vote Now!!!');
        $mail->isHTML(true);

        $mail->Subject = "BSU Hagonoy - Vote Now For Our Student Governments";

        $row = $result->fetch_assoc();
        $recipient_email = $row['email_address'];
        $password_student = $row["password_student"];
        $original_passwordpart1 = substr($password_student, 11, 4);
        $original_passwordpart2 = substr($password_student, 19, 3);
        $original_password = $original_passwordpart1 . $original_passwordpart2;

        $email_content = '
                <html lang="en">
    
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>HTML email template</title>
                    <style>
                    * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }
            
                    body {
                        background-color: white;
                        font-family: sans-serif;
                        min-height: 100vh;
                    }
            
                    .main {
                        width: 768px;
                        margin: 0 auto;
                        font-size: 16px;
                    }
            
                    h1 {
                        padding: 15px;
                        background-color: #006400;
                        color: white;
                        margin-top: 10px;
                        margin-bottom: 10px;
                    }
            
                    h2 {
                        font-size: 20px;
                        margin: 20px 0px 10px 0px;
                    }
            
                    p {
                        margin: 30px 0px 30px 0px;
                    }
            
                    #passwordshow {
                        margin-bottom: 3%;
                    }
            
                    #proceedbtn {
                        cursor: pointer;
                        padding: 15px 40px 15px 40px;
                        background-color: #006400;
                        color: white;
                        text-decoration: none;
                        font-size: 20px;
                    }
            
                    #proceedbtn:hover {
                        background-color: #004300;
                    }
                </style>
            </head>
    
            <body>
                <div class="main">
                    <h1>New Password - You May Now Vote!!!</h1>
                    <h2>From: BulSU Hagonoy LSC</h2>
                    <p>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;Embrace the convenience of our user-friendly online voting system, where participation 
                        is just a click away. Before casting your vote, take a moment to thoroughly review each 
                        candidate\'s platform and qualifications, ensuring alignment with your values. Your informed 
                        choice is pivotal in shaping the future of our institution/organization. Your voice matters, 
                        a testament to the strength of our democracy. Let\'s unite for a positive impact—cast your 
                        vote today to shape a promising future for our community. Don\'t miss this chance to be an 
                        active participant in the decision-making process.
                        <br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;Voters may now cast their votes using the latest password on the designated date for voting. 
                        Make sure to participate within the specified time window to contribute to the democratic process.
                    </p>
    
                    <div id="passwordshow">
                        <h2>NEW PASSWORD: ' . $original_password . '</h2>
                    </div>
                    <a id="proceedbtn" href="http://bsuhagonoy-campus-voice.free.nf">CLICK HERE TO PROCEED...</a>
                    
                </div>
            </body>
    
            </html>
                ';

        $mail->clearAddresses();
        $mail->addAddress($recipient_email);
        $mail->Body = $email_content;

        try {
            $mail->send();
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
        }

        if (isset($_SESSION['Batch'])) {
            $currentBatch = $_SESSION['currentBatch'];
            $sqlupdate_emailsend = "UPDATE `students_batch$currentBatch` SET sendpass = 'Yes' WHERE email_address = '$recipient_email'";
        } else {
            $defaultBatch = $_SESSION['defaultBatch'];
            $sqlupdate_emailsend = "UPDATE `students_batch$defaultBatch` SET sendpass = 'Yes' WHERE email_address = '$recipient_email'";
        }

        // Execute the update query
        if ($conn->query($sqlupdate_emailsend) === TRUE) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No records found in the database.";
    }
}