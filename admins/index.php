<?php
// if ($_SERVER["HTTPS"] != "on") {
//     header("Location: https://bsuhagonoy-campus-voice.free.nf/admins/");
//     exit();
// }
include_once './back_end/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && $_POST['password'] != "") {

        $username = strtolower($_POST["username"]);
        $password = $_POST["password"];

        // Check 'admins' table first
        $sqlAdmin = "SELECT * FROM `admins` WHERE username_admin = ? AND status = 'activated'";
        $stmtAdmin = $conn->prepare($sqlAdmin);
        $stmtAdmin->bind_param("s", $username);

        // Execute the prepared statement for 'admins' table
        if ($stmtAdmin->execute()) {
            $resultAdmin = $stmtAdmin->get_result();

            // Check if a row was returned from 'admins' table
            if ($resultAdmin->num_rows === 1) {
                $rowAdmin = $resultAdmin->fetch_assoc();
                $storedPasswordAdmin = $rowAdmin["password_admin"];

                $adminpassword = hash('sha256', $Salt . $password . $Pepper);

                // Check if the entered password matches the stored password for 'admins' table
                if ($adminpassword == $storedPasswordAdmin) {
                    session_start();
                    $_SESSION['Logged_in_Admin'] = $adminpassword;

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

                            $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Login','$admin','$currentDateFormatted/$currentTime12Hour')";
                            mysqli_query($conn, $sql_reports);
                        }
                    }
                    // Password is correct for 'admins', show success message and redirect
                    echo "<script>window.location.href = './admin_section/index.php';</script>";
                    exit; // Make sure to exit after redirection
                }
            }
        } else {
            echo "Error: " . $stmtAdmin->error;
        }

        // Close the prepared statement for 'admins' table
        $stmtAdmin->close();

        // Check 'super_admin' table
        $sqlSuperAdmin = "SELECT * FROM `super_admin` WHERE username_superadmin = ?";
        $stmtSuperAdmin = $conn->prepare($sqlSuperAdmin);
        $stmtSuperAdmin->bind_param("s", $username);

        // Execute the prepared statement for 'super_admin' table
        if ($stmtSuperAdmin->execute()) {
            $resultSuperAdmin = $stmtSuperAdmin->get_result();

            // Check if a row was returned from 'super_admin' table
            if ($resultSuperAdmin->num_rows === 1) {
                $rowSuperAdmin = $resultSuperAdmin->fetch_assoc();
                $storedPasswordSuperAdmin = $rowSuperAdmin["password_superadmin"];
                $statusSuperAdmin = $rowSuperAdmin["status"];

                $superadminpassword = hash('sha256', $Salt . $password . $Pepper);
               
                // Check if the entered password matches the stored password for 'super_admin' table
                if (($superadminpassword == $storedPasswordSuperAdmin && $statusSuperAdmin == "activated") || 
                ($superadminpassword == $storedPasswordSuperAdmin && $statusSuperAdmin == "main_account")) {
                    session_start();
                    $_SESSION['Logged_in_Superadmin'] = $superadminpassword;

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

                            $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Login','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                            mysqli_query($conn, $sql_reports);
                        }
                    }

                    $sql_update = "UPDATE lsc_election_list SET status = 'deactivated'";
                    $result = $conn->query($sql_update);
                    if ($result) {
                        $sql_activate = "UPDATE lsc_election_list SET status = 'activated' ORDER BY lscbatch_id DESC LIMIT 1";
                        mysqli_query($conn, $sql_activate);

                        // Password is correct for 'super_admin', show success message and redirect
                        echo "<script>window.location.href = './superadmin_section/index.php';</script>";
                        exit;
                    }
                    
                }
            }
        } else {
            echo "Error: " . $stmtSuperAdmin->error;
        }

        // Close the prepared statement for 'super_admin' table
        $stmtSuperAdmin->close();

        // If none of the login attempts are successful, show error message
        echo "
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js'></script>
        <script>
            $.confirm({
                title: 'Password',
                content: 'Your Username/Password is Incorrect',
                autoClose: 'cancelAction|3000',
                buttons: {
                    cancelAction: {
                        text: 'Try Again',
                        action: function () {
                        },
                        btnClass: 'btn-ok',
                    },
                },
                titleClass: 'my-title-class',
            });
        </script>
        ";
    } else {
        echo "<script>alert('Sorry but you need to fill up first');</script>";
        echo "<script>form.reset();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Primary Meta Tags -->
    <meta name="title" content="Admins | Campus Voice - Voting System" />
    <meta name="description" content="This was created for our capstone project, a voting system for the Local Student Council at Bulacan State University - Hagonoy Campus." />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Admins | Campus Voice - Voting System" />
    <meta property="og:description" content="This was created for our capstone project, a voting system for the Local Student Council at Bulacan State University - Hagonoy Campus." />
    <meta property="og:image" content="./images/MetaPicAdmin.JPG" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="./images/LSC_Logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="admin.css">
    <title>Login</title>
</head>

<body>
    <header>
        <div class="logo"><a href="index.php"><img src="./images/BSUHagonoyandLSC-Logo.png" alt=""></a></div>
        <div class="text">
            <h1>Bulacan State University</h1>
            <h4>Hagonoy Bulacan</h4>
            <h5>Student Government - Local Student Council</h5>
        </div>
    </header>
    <div id="background-header-1"></div>
    <div id="background-header-2"></div>
    <div id="background-image"></div>
    <div class="login">
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>ADMIN</h1><br>
            <h4>Username</h4>
            <div class="container-input">
                <img src="./assets/username_icon.png" alt="">
                <input class="input" type="text" name="username" id="username" placeholder="Enter Your Username" autocomplete="off" required>
            </div><br>
            <h4>Password</h4>
            <div class="container-input">
                <img src="./assets/password_icon.png" alt="">
                <input class="input" type="password" name="password" id="password" placeholder="Enter Your Password" autocomplete="off" required>
            </div>
            <div class="container-input">
                <input id="button" type="submit" value="LOG IN">
            </div>
        </form>
    </div>
    <div class="error404">
        <div class="error404-Top">
            <div class="error404-Top1">
                <h1 id="txt1">Oppss!!!</h1>
                <h1 id="txt2">#404</h1>
            </div>
            <div class="error404-Top2">
                <img id="img1" src="./assets/404.png" alt="">
            </div>
        </div>
        <div class="error404-Bottom">
            <h1 class="txt3">This website is not<br> available with your device</h1>
            <h1 class="txt4">This website is not accessible on your current device. Please ensure that your device's display resolution meets the minimum requirement of 1280 pixels width or higher.</h1>
        </div>
    </div>
    <script src="admin.js"></script>
</body>

</html>