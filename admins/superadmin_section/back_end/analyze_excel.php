<?php
//include 'config.php';
include 'checker.php';
include_once('connection.php');

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

// Function to get initials from the middle name
function getMiddleNameInitials($middleName)
{
    $words = explode(' ', $middleName);
    $initials = '';
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1)) . '.';
    }
    return rtrim($initials, '.'); // Remove trailing period if it exists
}

function removePeriods($string)
{
    return str_replace('.', '', $string);
}

if (isset($_FILES['import_file']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = 0;
        foreach ($data as $row) {
            $count++;

            // Skip the first 13 rows
            if ($count <= 9) {
                continue;
            }

            $deactivate = 'deactivated';
            $unvoted = 'unvoted';
            $randompass = generateRandomPassword();
            $randompasspart1 = substr($randompass, 0, 4);
            $randompasspart2 = substr($randompass, 4, 3);
            $generateRandomPassword = hash('sha256', $Salt . $randompass . $Pepper);
            $randomPassword = substr_replace($generateRandomPassword, $randompasspart1, 11, 0);
            $randomPassword = substr_replace($randomPassword, $randompasspart2, 19, 0);
            $CYSG = strtoupper($row['0']);
            $StudentID = preg_replace('/[^0-9]/', '', $row['1']);

            $FirstName = ucfirst(strtolower(trim($row['2'])));
            $UppercaseFirstName = ucwords($FirstName); //Kada words is gagawin bigletter una
            $LastName = ucfirst(strtolower(trim($row['3'])));
            $MiddleName = ucfirst(strtolower(trim($row['4'])));
            $MiddleInitialOnly = strtoupper(getMiddleNameInitials($MiddleName));
            $Suffix = strtolower(trim(str_replace('.', '', $row['5'])));

            $FirstNameConverted = str_replace(['Ñ', 'ñ'], ['N', 'n'], $UppercaseFirstName);
            $FirstNameConverted = preg_replace('/\s+/', '', $FirstNameConverted);
            $LastNameConverted = str_replace(['Ñ', 'ñ'], ['N', 'n'], $LastName);
            $LastNameConverted = preg_replace('/\s+/', '', $LastNameConverted);
            $MiddleNameConverted = str_replace(['Ñ', 'ñ'], ['N', 'n'], $MiddleInitialOnly);

            $MI = removePeriods($MiddleNameConverted);

            if ($Suffix != "") {
                $EmailAddress = strtolower($FirstNameConverted . '.' . $LastNameConverted . '' . $Suffix . '.' . $MI . '@bulsu.edu.ph');
            } else {
                $EmailAddress = strtolower($FirstNameConverted . '.' . $LastNameConverted . '.' . $MI . '@bulsu.edu.ph');
            }

            if (isset($_SESSION['Batch'])) {
                $currentBatch = $_SESSION['currentBatch'];
                $mysql_checker = "SELECT * FROM `students_batch$currentBatch` WHERE student_id LIKE '$StudentID'";
            } else {
                $defaultBatch = $_SESSION['defaultBatch'];
                $mysql_checker = "SELECT * FROM `students_batch$defaultBatch` WHERE student_id LIKE '$StudentID'";
            }

            $checker_result = $conn->query($mysql_checker);
            // Check if similar record already exists in the database
            if ($checker_result->num_rows == 1) {
                continue;
            } else {
                if (empty($StudentID) || empty($CYSG)) {
                    break;
                }
                if (isset($_SESSION['Batch'])) {
                    $currentBatch = $_SESSION['currentBatch'];
                    $sql = "INSERT INTO `students_batch$currentBatch` (student_id, password_student, Fname, 
                    Lname, Mname, suffix, cysg, status, account, email_address, sendpass) VALUES ('$StudentID', '$randomPassword', '$UppercaseFirstName', '$LastName', '$MiddleName', '$Suffix', '$CYSG', '$unvoted', '$deactivate', '$EmailAddress', 'No')";
                } else {
                    $defaultBatch = $_SESSION['defaultBatch'];
                    $sql = "INSERT INTO `students_batch$defaultBatch` (student_id, password_student, Fname, 
                    Lname, Mname, suffix, cysg, status, account, email_address, sendpass) VALUES ('$StudentID', '$randomPassword', '$UppercaseFirstName', '$LastName', '$MiddleName', '$Suffix', '$CYSG', '$unvoted', '$deactivate', '$EmailAddress', 'No')";
                }
                $result = $conn->query($sql);

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

                        $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Added new student accounts.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
                        mysqli_query($conn, $sql_reports);
                    }
                }
            }
        }
    } else {
        header("Location: ./index.php");
        exit(0);
    }
}

?>