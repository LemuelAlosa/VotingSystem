<?php
include 'checker.php';
require '../generateResult_fpdf186/fpdf.php';
require 'connection.php';

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

        $sql_reports = "INSERT INTO `$audittrial_reportbatch`(`reports`, `account`, `date/time`) VALUES ('Generate the Final VoteTally via PDF.','$superadmin','$currentDateFormatted/$currentTime12Hour')";
        mysqli_query($conn, $sql_reports);
    }
}

function getMiddleNameInitials($Mname)
{
    $words = explode(' ', $Mname);
    $initials = '';
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1)) . '.';
    }
    return rtrim($initials, '.'); // Remove trailing period if it exists
}

$pdf = new FPDF();
$pdf->AddPage('P', 'A4');
$pdf->SetMargins(10, 10, 10);
// FOR HEADER

$pdf->Image('../images/BulSUHagonoy_Logo.png', 30, 10, 25);
$pdf->Image('../images/LSC_Logo.png', 160, 10, 25);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 5, 'Republic of the Philippines', 0, 1, 'C');
$pdf->Cell(0, 5, 'BulSU - Hagonoy Campus', 0, 1, 'C');
$pdf->Cell(0, 5, 'Iba-Carillo, Hagonoy', 0, 1, 'C');
$pdf->Cell(0, 5, 'Student Government - Local Student Council', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 20);
$pdf->Cell(0, 10, 'Vote Tally Report', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);
$pdf->Cell(160, 10, '', 0, 1);
$query = "SELECT lscbatch_list FROM `lsc_election_list` WHERE status = 'activated'";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);
$lscbatchList = $row['lscbatch_list'];
$pdf->Cell(0, 5, $lscbatchList, 0, 1, 'L');
$pdf->Cell(0, 5, 'Printed Date: ' . date('Y-m-d'), 0, 1, 'L');

$pdf->SetFillColor(167, 211, 151);

$pdf->Rect(0, $pdf->getY(), $pdf->getPageWidth(), 2, 'F');
$pdf->Ln(3);
$pdf->Rect(0, $pdf->getY(), $pdf->getPageWidth(), 0, 'F');
$pdf->Ln(10);

$pdf->SetFont('Times', '', 12);
$pdf->setXY(($pdf->getPageWidth() - 160) / 2, $pdf->getY());

$candidateposition = $_SESSION['candidatePosition'];
$candidatebatch = $_SESSION['CandidateBatch'];

$sql_search = "SELECT * FROM `$candidateposition`";
$result_outer = $conn->query($sql_search);

$num = 0;
$isFirstIteration = true;

if ($result_outer->num_rows > 0) {
    while ($rowstored = $result_outer->fetch_assoc()) {
        $position = strtoupper($rowstored["position"]);
        $num++;
        $data[$num] = array();

        $sql_search1 = "SELECT * FROM `$candidatebatch` WHERE Position = '$position' ORDER BY votes DESC";
        $result_inner = $conn->query($sql_search1);

        if ($result_inner->num_rows > 0) {
            while ($row_inner = $result_inner->fetch_assoc()) {

                $fullname_candidate = '';
                $Fname = $row_inner["Firstname_candidate"];
                $Lname = $row_inner["Lastname_candidate"];
                $Mname = strtoupper(getMiddleNameInitials($row_inner["Middlename_candidate"]));
                $Suffix = strtoupper($row_inner["suffix"]);

                if ($Mname != "") {
                    if ($Suffix != "") {
                        $fullname_candidate = $Lname . ', ' . $Fname . ' ' . $Suffix . ' ' . $Mname . '.';
                    } else {
                        $fullname_candidate = $Lname . ', ' . $Fname . ' ' . $Mname . '.';
                    }
                } else {
                    $fullname_candidate = $Lname . ', ' . $Fname;
                }

                $data[$num][] = array(
                    'candidate' => $fullname_candidate,
                    'votes' => $row_inner['votes']
                );
            }
        } else {
            $data[$num][] = array(
                'candidate' => 'No Candidate',
                'votes' => '-'
            );
        }

        // PER POSITION
        if ($isFirstIteration) {
            $pdf->Cell(160, 10, $position, 1, 1, 'C', true);
            $pdf->setXY(($pdf->getPageWidth() - 160) / 2, $pdf->getY());
            $pdf->Cell(80, 10, 'Candidate', 1, 0, 'C');
            $pdf->Cell(80, 10, 'Votes', 1, 1, 'C');
        } else {
            $pdf->Cell(160, 10, '', 0, 1);
            $pdf->setXY(($pdf->getPageWidth() - 160) / 2, $pdf->getY());
            $pdf->Cell(160, 10, $position, 1, 1, 'C', true);
            $pdf->setXY(($pdf->getPageWidth() - 160) / 2, $pdf->getY());
            $pdf->Cell(80, 10, 'Candidate', 1, 0, 'C');
            $pdf->Cell(80, 10, 'Votes', 1, 1, 'C');
        }

        foreach ($data[$num] as $candidate) {
            $pdf->setXY(($pdf->getPageWidth() - 160) / 2, $pdf->getY());
            $pdf->Cell(80, 10, $candidate['candidate'], 1, 0, 'C');
            $pdf->Cell(80, 10, $candidate['votes'], 1, 1, 'C');
        }

        // Set the flag to false after the first iteration
        $isFirstIteration = false;

    }
}

$pdf->Ln(5);
$pdf->Cell(0, 5, '***Nothing Follows***', 0, 1, 'C');

// SIGNATURE PART 
$query = "SELECT lscbatch_list FROM `lsc_election_list` WHERE status = 'activated'";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);
$lscbatchList = $row['lscbatch_list'];

$pdf->Cell(160, 10, '', 0, 1);
$pdf->Cell(0, 10, '     Please sign here to certify that you have reviewed and verified the accuracy of the', 0, 1, 'C');
$pdf->Cell(0, 10, 'voting tally report for ' . $lscbatchList . ' ,and that you acknowledge the results as an       ', 0, 1, 'C');
$pdf->Cell(0, 10, 'accurate representation of the votes.                                                                                        ', 0, 1, 'C');

function displaysuperadmins($pdf, $title, $countQuery, $dataQuery, $conn)
{
    $countResult = $conn->query($countQuery);
    $countRow = $countResult->fetch_assoc();
    $count = $countRow['count'];

    $dataResult = $conn->query($dataQuery);

    $columnWidth = $pdf->GetPageWidth() / 2;
    $pdf->Cell(160, 10, '', 0, 1);

    $s_admin = 0;
    while ($row = $dataResult->fetch_assoc()) {
        $s_admin++;

        $x = 30; // Adjust the left margin as needed
        $y = $pdf->getY();

        $pdf->setXY($x, $pdf->getY());
        $pdf->Cell($columnWidth, 10, $title, 0, 0, 'C');
        $pdf->Cell(-23, 10, $_SESSION['superadmin' . $s_admin], 0, 1, 'C');

        $underlineLength = 50;
        $underlineX = 44 + $columnWidth - $underlineLength; // Adjust as needed
        $pdf->Line($underlineX, $y + 7, $underlineX + $underlineLength, $y + 7);
    }
}

// Display Super Admins in the left column
$countQuerySuperAdmin = "SELECT COUNT(*) as count FROM super_admin";
$dataQuerySuperAdmin = "SELECT * FROM super_admin LIMIT 1, 18446744073709551615";
displaysuperadmins($pdf, 'Super Admin', $countQuerySuperAdmin, $dataQuerySuperAdmin, $conn);

function displayadmins($pdf, $title, $countQuery, $dataQuery, $conn)
{
    $countResult = $conn->query($countQuery);
    $countRow = $countResult->fetch_assoc();
    $count = $countRow['count'];

    $dataResult = $conn->query($dataQuery);

    $columnWidth = $pdf->GetPageWidth() / 2;
    $pdf->Cell(160, 10, '', 0, 1);

    $a_admin = 0;
    while ($row = $dataResult->fetch_assoc()) {
        $a_admin++;

        $x = 30; // Adjust the left margin as needed
        $y = $pdf->getY();

        $pdf->setXY($x, $pdf->getY());
        $pdf->Cell($columnWidth, 10, $title, 0, 0, 'C');
        $pdf->Cell(-23, 10, $_SESSION['admin' . $a_admin], 0, 1, 'C');

        $underlineLength = 50;
        $underlineX = 44 + $columnWidth - $underlineLength; // Adjust as needed
        $pdf->Line($underlineX, $y + 7, $underlineX + $underlineLength, $y + 7);
    }
}

// Display Admins in the right column
$countQueryAdmin = "SELECT COUNT(*) as count FROM admins";
$dataQueryAdmin = "SELECT * FROM admins";
displayadmins($pdf, 'Admin', $countQueryAdmin, $dataQueryAdmin, $conn);

// Output PDF as a downloadable file
try {
    ob_start();
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="VoteTally_Report.pdf"');
    $pdf->Output('D', 'VoteTally_Report.pdf');
    ob_end_flush();

    $superAdminCount = 10;
    for ($i = 1; $i <= $superAdminCount; $i++) {
        $superAdminKey = "superadmin{$i}";
        unset($_SESSION[$superAdminKey]);
    }

    $adminCount = 10;
    for ($i = 1; $i <= $adminCount; $i++) {
        $adminKey = "admin{$i}";
        unset($_SESSION[$adminKey]);
    }
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}
?>