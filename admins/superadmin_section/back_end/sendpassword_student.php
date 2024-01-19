<?php
//include 'config.php';
include 'connection.php';
include 'checker.php';

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($_SESSION['waytosend'] == 'NotAll'){
    if (isset($_SESSION['Batch'])) {
        $currentBatch = $_SESSION['currentBatch'];
        $sql = "SELECT * FROM `students_batch$currentBatch` WHERE sendpass = 'No'";
    } else {
        $defaultBatch = $_SESSION['defaultBatch'];
        $sql = "SELECT * FROM `students_batch$defaultBatch` WHERE sendpass = 'No'";
    }
    $result = $conn->query($sql);
    
    $StartVoting = $_SESSION['start'];
    $StopVoting = $_SESSION['stop'];
    $VotingDate = $_SESSION['votingdate'];
    
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
    
        while ($row = $result->fetch_assoc()) {
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
                    <h1>You May Now Vote!!!</h1>
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
                        &nbsp;Voting is scheduled to commence at ' . $StartVoting . ' and will conclude at 
                        ' . $StopVoting . '. Be sure to cast your vote within this designated time window 
                        to contribute to the democratic process. The voting is scheduled for ' . $VotingDate . '.
                    </p>
    
                    <div id="passwordshow">
                        <h2>PASSWORD: ' . $original_password . '</h2>
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
                $sqlupdate = "UPDATE `students_batch$currentBatch` SET sendpass = 'Yes' WHERE email_address = '$recipient_email'";
            } else {
                $defaultBatch = $_SESSION['defaultBatch'];
                $sqlupdate = "UPDATE `students_batch$defaultBatch` SET sendpass = 'Yes' WHERE email_address = '$recipient_email'";
            }
            mysqli_query($conn, $sqlupdate);
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

                $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Students haven't received their passwords yet; they have been sent.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                mysqli_query($conn, $sql_reports);
            }
        }

        echo "Success";
        $conn->close();
    } else {
        echo "No records found in the database.";
    }

}elseif($_SESSION['waytosend'] == 'All'){
    if (isset($_SESSION['Batch'])) {
        $currentBatch = $_SESSION['currentBatch'];
        $sql = "SELECT * FROM `students_batch$currentBatch`";
    } else {
        $defaultBatch = $_SESSION['defaultBatch'];
        $sql = "SELECT * FROM `students_batch$defaultBatch`";
    }
    $result = $conn->query($sql);
    
    $StartVoting = $_SESSION['start'];
    $StopVoting = $_SESSION['stop'];
    $VotingDate = $_SESSION['votingdate'];
    
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
    
        while ($row = $result->fetch_assoc()) {
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
                    <h1>You May Now Vote!!!</h1>
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
                        &nbsp;Voting is scheduled to commence at ' . $StartVoting . ' and will conclude at 
                        ' . $StopVoting . '. Be sure to cast your vote within this designated time window 
                        to contribute to the democratic process. The voting is scheduled for ' . $VotingDate . '.
                    </p>
    
                    <div id="passwordshow">
                        <h2>PASSWORD: ' . $original_password . '</h2>
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
                $sqlupdate = "UPDATE `students_batch$currentBatch` SET sendpass = 'Yes' WHERE email_address = '$recipient_email'";
            } else {
                $defaultBatch = $_SESSION['defaultBatch'];
                $sqlupdate = "UPDATE `students_batch$defaultBatch` SET sendpass = 'Yes' WHERE email_address = '$recipient_email'";
            }
            mysqli_query($conn, $sqlupdate);

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

                $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('All students have been sent their passwords via email.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                mysqli_query($conn, $sql_reports);
            }
        }

        echo "Success";
        $conn->close();
    } else {
        echo "No records found in the database.";
    }

}elseif($_SESSION['waytosend'] == 'Resched'){
    if (isset($_SESSION['Batch'])) {
        $currentBatch = $_SESSION['currentBatch'];
        $sql = "SELECT * FROM `students_batch$currentBatch`";
    } else {
        $defaultBatch = $_SESSION['defaultBatch'];
        $sql = "SELECT * FROM `students_batch$defaultBatch`";
    }
    $result = $conn->query($sql);
    
    $StartVoting = $_SESSION['start'];
    $StopVoting = $_SESSION['stop'];
    $VotingDate = $_SESSION['votingdate'];
    
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
    
        while ($row = $result->fetch_assoc()) {
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
                    <h1>You May Now Vote!!!</h1>
                    <h2>From: BulSU Hagonoy LSC</h2>
                    <p>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;We have <b>rescheduled</b> the voting process to better accommodate everyone. 
                        Before casting your vote, take a moment to thoroughly review each candidate\'s 
                        platform and qualifications, ensuring alignment with your values. Your informed 
                        choice remains pivotal in shaping the future of our institution/organization. 
                        Your voice matters, a testament to the strength of our democracy. 
                        <br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;Let\'s unite for a positive impact—cast your vote on the newly scheduled date, 
                        ' . $VotingDate . ', from ' . $StartVoting . ' to ' . $StopVoting . '. Don\'t miss this chance to be an active 
                        participant in the decision-making process. Click below to access our online voting 
                        platform and make your voice heard.
                    </p>
    
                    <div id="passwordshow">
                        <h2>PASSWORD: ' . $original_password . '</h2>
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
                $sqlupdate = "UPDATE `students_batch$currentBatch` SET sendpass = 'Yes' WHERE email_address = '$recipient_email'";
            } else {
                $defaultBatch = $_SESSION['defaultBatch'];
                $sqlupdate = "UPDATE `students_batch$defaultBatch` SET sendpass = 'Yes' WHERE email_address = '$recipient_email'";
            }
            mysqli_query($conn, $sqlupdate);

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

                $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('All students have been sent their passwords along with the new rescheduled date for voting.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                mysqli_query($conn, $sql_reports);
            }
        }
        
        echo "Success";
        $conn->close();
    } else {
        echo "No records found in the database.";
    }


}

unset($_SESSION['waytosend']);
unset($_SESSION['start']);
unset($_SESSION['stop']);
unset($_SESSION['votingdate']);

?>