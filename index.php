<?php
// if ($_SERVER["HTTPS"] != "on") {
//     header("Location: https://bsuhagonoy-campus-voice.free.nf");
//     exit();
// }
include_once './back_end/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['studentid']) && $_POST['studentpassword'] != "") {

        $studentid = $_POST["studentid"];
        $studentpassword = $_POST["studentpassword"];

        // Check 'admins' table first
        $sql = "SELECT * FROM `lsc_election_list` WHERE status = 'activated'";
        $resultDB = $conn->query($sql);

        // Check if a row was returned from 'admins' table
        if ($resultDB->num_rows === 1) {
            $rowDB = $resultDB->fetch_assoc();
            $storedbatch = $rowDB["students_batch"];

            $sqlstudent = "SELECT * FROM `$storedbatch` WHERE student_id = '$studentid' AND account = 'activated'";
            $resultStudent = $conn->query($sqlstudent);

            if ($resultStudent->num_rows === 1) {
                $rowStudent = $resultStudent->fetch_assoc();
                $storedPasswordStudent = $rowStudent["password_student"];

                $sqlstudentVoted = "SELECT * FROM `$storedbatch` WHERE student_id = '$studentid' AND account = 'activated' AND status = 'voted'";
                $resultStudentVoted = $conn->query($sqlstudentVoted);

                if ($resultStudentVoted->num_rows === 1) {
                    $randompasspart1 = substr($studentpassword, 0, 4);
                    $randompasspart2 = substr($studentpassword, 4, 3);
                    $HashStudentPassword = hash('sha256', $Salt . $studentpassword . $Pepper);
                    $studentEnterPassword = substr_replace($HashStudentPassword, $randompasspart1, 11, 0);
                    $studentEnterPassword = substr_replace($studentEnterPassword, $randompasspart2, 19, 0);

                    if ($studentEnterPassword == $storedPasswordStudent) {
                        session_start();
                        $_SESSION['Logged_in'] = $studentEnterPassword;
                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelector('.voted').style.display = 'block';
                                document.querySelector('.reminder').style.display = 'none';
                            });
                         </script>";
                    } else {
                        echo "
                        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css'>
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js'></script>
                        <script>
                            $.confirm({
                                title: 'Password',
                                content: 'Your Student ID/Password is Incorrect',
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
                    }

                } else {
                    $randompasspart1 = substr($studentpassword, 0, 4);
                    $randompasspart2 = substr($studentpassword, 4, 3);
                    $HashStudentPassword = hash('sha256', $Salt . $studentpassword . $Pepper);
                    $studentEnterPassword = substr_replace($HashStudentPassword, $randompasspart1, 11, 0);
                    $studentEnterPassword = substr_replace($studentEnterPassword, $randompasspart2, 19, 0);

                    if ($studentEnterPassword == $storedPasswordStudent) {
                        session_start();
                        $_SESSION['Logged_in'] = $studentEnterPassword;
                        echo "<script>window.location.href = './voting_section/index.php';</script>";
                        exit;
                    } else {
                        echo "
                        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css'>
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js'></script>
                        <script>
                            $.confirm({
                                title: 'Password',
                                content: 'Your Student ID/Password is Incorrect',
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
                    }
                }
            } else {
                echo "
                    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>
                    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css'>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js'></script>
                    <script>
                        $.confirm({
                            title: 'LSC Voting Status',
                            content: 'LSC Voting is currently not activated. Please check back later.',
                            autoClose: 'cancelAction|3000',
                            buttons: {
                                cancelAction: {
                                    text: 'Try Again',
                                    action: function () {
                                        '.return;.'
                                    },
                                    btnClass: 'btn-ok',
                                },
                            },
                            titleClass: 'my-title-class',
                        });
                    </script>
                    ";
            }

        } else {
            echo "Error: " . $conn->error;
        }

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
    <meta name="title" content="Students | Campus Voice - Voting System" />
    <meta name="description"
        content="This was created for our capstone project, a voting system for the Local Student Council at Bulacan State University - Hagonoy Campus." />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Students | Campus Voice - Voting System" />
    <meta property="og:description"
        content="This was created for our capstone project, a voting system for the Local Student Council at Bulacan State University - Hagonoy Campus." />
    <meta property="og:image" content="./images/MetaPic.JPG" />


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="./images/LSC_Logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="student.css">
    <title>Login</title>
</head>

<body>
    <header>
        <div class="logo"><a href="index.php"><img src="./images/BSUHagonoyandLSC-Logo.png" alt=""></a></div>
        <div class="text">
            <h1>Bulacan State University</h1>
            <h4>Hagonoy Bulacan</h4>
            <h5><span>Student Government -&nbsp;</span>Local Student Council</h5>
        </div>
    </header>
    <div id="background-header-1"></div>
    <div id="background-header-2"></div>
    <div id="background-image"></div>
    <div class="main">
        <div class="login">
            <form action="" method="POST" enctype="multipart/form-data">
                <h1>Vote Now!!!</h1><br>
                <h4>Student ID</h4>
                <div class="container-input">
                    <img src="./assets/username_icon.png" alt="">
                    <input class="input" type="text" name="studentid" id="studentid" placeholder="Enter Your Student ID"
                        autocomplete="off" required>
                </div><br>
                <h4>Password</h4>
                <div class="container-input">
                    <img src="./assets/password_icon.png" alt="">
                    <input class="input" type="password" name="studentpassword" id="studentpassword"
                        placeholder="Enter Your Password" autocomplete="off" required>
                    <img id="show" src="./assets/show.png" id="show" onclick="studentPasswordshowhide();" alt="">
                    <img id="hide" src="./assets/hide.png" id="hide" onclick="studentPasswordshowhide();" alt="">
                </div>
                <div class="container-input">
                    <input id="button" type="submit" value="LOG IN">
                </div>
            </form>
            <div class="reminder">
                <h2 id="note">NOTE:</h2>
                <h2 id="details">Your Power, Your Voice: Vote Wisely and Make a Difference!</h2>
            </div>
            <div class="voted">
                <h2 id="votednote">You Already Voted!!!</h2>
                <div class="seeresultbtn" onclick="seeResult();">
                    <img src="./assets/seeresults.png" alt="">
                    <h2>See Live Result Here...</h2>
                </div>
            </div>
        </div>
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
            <h1 class="txt4">Make sure your display resolution is 1280 width+</h1>
        </div>
    </div>
    <script src="student.js"></script>
</body>

</html>