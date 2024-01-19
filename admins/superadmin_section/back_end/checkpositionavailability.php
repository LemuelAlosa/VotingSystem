<?php
include 'checker.php';
include_once './connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['position'])) {
        
        $candidateposition = $_SESSION['candidatePosition'];
        $position = $_POST['position'];

        $sql = "SELECT * FROM `$candidateposition` WHERE position = '$position'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo 'AlreadyExist';
        }else{
            //Didn't Exist
        }
    }
}
exit();