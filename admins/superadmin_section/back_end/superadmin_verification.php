<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

$StartVoting = '';
$StopVoting = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])) {

        //ITO PART NA ITO IS PARA SA PAGSSEND NG EMAIL
        if(isset($_POST['Choose'])){
            if($_POST['Choose'] == 'NotAll'){
                $_SESSION['waytosend'] = 'NotAll';
            } elseif($_POST['Choose'] == 'All'){
                $_SESSION['waytosend'] = 'All';
            } elseif($_POST['Choose'] == 'Resched'){
                $_SESSION['waytosend'] = 'Resched';
            }
        }
        
        if(isset($_POST['start']) && isset($_POST['stop']) && isset($_POST['votingdate'])){
            $StartVoting = date('h:i A', strtotime($_POST['start']));
            $StopVoting = date('h:i A', strtotime($_POST['stop']));
            $VotingDate = date("F j, Y", strtotime($_POST['votingdate']));
        
            $_SESSION['start'] = $StartVoting;
            $_SESSION['stop'] = $StopVoting;
            $_SESSION['votingdate'] = $VotingDate;
        }
        
        //BACK TO NORMAL
        $password = $_POST["password"];
        $superadminpassword = hash('sha256', $Salt . $password . $Pepper);

        $sql = "SELECT * FROM `super_admin` WHERE password_superadmin = '$superadminpassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Password is correct
        }else{
            echo 'incorrect';
        }
    }
}
exit();