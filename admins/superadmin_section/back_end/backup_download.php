<?php
//include 'config.php';
include 'checker.php';
include_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])) {

        $password = $_POST["password"];
        $superadminpassword = hash('sha256', $Salt . $password . $Pepper);

        $sql = "SELECT * FROM `super_admin` WHERE password_superadmin = '$superadminpassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $passwordCorrect = true; // Password is correct
        } else {
            echo 'incorrect';
        }
    }
}

if ($passwordCorrect) {
    $tables = array();
    $result = mysqli_query($conn, "SHOW TABLES");
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }
    $return = '';

    // Append the provided SQL statements
    $return .= "--\n";
    $return .= "-- Backup Database For BulSU Hagonoy - LSC Election";
    $return .= "-- First YOU MUST CREATE DATABASE named bulsuhagonoy_localstudentcouncil_electiondatabase";
    $return .= "-- After that you may now Important this file on your Database\n";

    $return .= "--\n\n";

    foreach ($tables as $table) {
        $result = mysqli_query($conn, "SELECT * FROM `" . $table . "`"); // Enclose table name in backticks
        $num_fields = mysqli_num_fields($result);

        $return .= 'DROP TABLE IF EXISTS `' . $table . '`;'; // Enclose table name in backticks
        $row2 = mysqli_fetch_row(mysqli_query($conn, "SHOW CREATE TABLE `" . $table . "`")); // Enclose table name in backticks
        $return .= "\n\n" . $row2[1] . ";\n\n";

        for ($i = 0; $i < $num_fields; $i++) {
            while ($row = mysqli_fetch_row($result)) {
                $return .= "INSERT INTO `" . $table . "` VALUES(";
                for ($j = 0; $j < $num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    if (isset($row[$j])) {
                        $return .= '"' . $row[$j] . '"';
                    } else {
                        $return .= '""';
                    }
                    if ($j < $num_fields - 1) {
                        $return .= ',';
                    }
                }
                $return .= ");\n";
            }
        }
        $return .= "\n\n\n";
    }

    // Save the SQL content to a file
    $backupFile = "backupdatabase_" . date("m-d-Y") . ".sql";
    $handle = fopen($backupFile, "w+");
    fwrite($handle, $return);
    fclose($handle);

    // Set headers to prompt download
    header('Content-Type: application/sql');
    header('Content-Disposition: attachment; filename="' . $backupFile . '"');
    header('Content-Length: ' . filesize($backupFile));

    // Output the file contents for download
    readfile($backupFile);

    // Delete the temporary backup file (optional)
    unlink($backupFile);

    exit(); // Terminate the script

} else {
    // Password is incorrect
    header("Location: ../index.php");
    exit();
}