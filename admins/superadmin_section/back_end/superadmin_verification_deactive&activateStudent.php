<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

$passwordCorrect = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])) {

        $password = $_POST["password"];
        $superadminpassword = hash('sha256', $Salt . $password . $Pepper);

        // Gumamit tayo ng prepared statement para sa SELECT query
        $sql = "SELECT * FROM `super_admin` WHERE password_superadmin = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $superadminpassword); // Bind ang parameter, s = string

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $passwordCorrect = true; // Password is correct
            } else {
                echo 'incorrect';
            }
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

if ($passwordCorrect) {
    
    if(isset($_SESSION['Batch'])){
        $currentBatch = $_SESSION['currentBatch'];
        $sql = "SELECT `account` FROM `students_batch$currentBatch` LIMIT 1";
    }else{
        $defaultBatch = $_SESSION['defaultBatch'];
        $sql = "SELECT `account` FROM `students_batch$defaultBatch` LIMIT 1";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $account = $row['account'];
        // Check the status and echo the appropriate response
        if ($account == 'activated') {
            echo 'deactivated';
        } elseif ($account == 'deactivated') {
            echo 'activated';
        }
    } else {
        echo 'unknown';
    }

}
exit();
