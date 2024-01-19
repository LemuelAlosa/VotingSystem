<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conn = new mysqli("localhost","root","","bulsuhagonoy_localstudentcouncil_electiondatabase");
// $conn = new mysqli("sql110.infinityfree.com","if0_35454243","bjyxMgERz06XJyp","if0_35454243_bulsuhagonoy_localstudentcouncil_electiondatabase");

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : '';
$filterSql = "";

if ($student_id !== '') {
    $filterSql = "WHERE student_id LIKE '%$student_id%'";
}

// Pagination configuration
$recordsPerPage = 10; // Number of records to show per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;
$currentPage = $page;

$Salt = "AlosaAcuñaBlancoHaliliLacsina";
$Pepper = "BSIT_4C_Batch2023-2024";


// Query with LIMIT and OFFSET for pagination
if(isset($_SESSION['Batch'])){
    $currentBatch = $_SESSION['currentBatch'];
    $sqlCount = "SELECT COUNT(*) as total FROM `students_batch$currentBatch` $filterSql";
}else{
    $defaultBatch = $_SESSION['defaultBatch'];
    $sqlCount = "SELECT COUNT(*) as total FROM `students_batch$defaultBatch` $filterSql";
}
$resultCount = $conn->query($sqlCount);
$totalRecords = $resultCount->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $recordsPerPage);

if(isset($_SESSION['Batch'])){
    $currentBatch = $_SESSION['currentBatch'];
    $sql = "SELECT * FROM `students_batch$currentBatch` $filterSql ORDER BY student_number DESC LIMIT $offset, $recordsPerPage";
}else{
    $defaultBatch = $_SESSION['defaultBatch'];
    $sql = "SELECT * FROM `students_batch$defaultBatch` $filterSql ORDER BY student_number DESC LIMIT $offset, $recordsPerPage";
}
$result = $conn->query($sql);

function getMiddleNameInitials($Mname) {
    $words = explode(' ', $Mname);
    $initials = '';
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1)) . '.';
    }
    return rtrim($initials, '.'); // Remove trailing period if it exists
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        // Access the individual fields from the database and display them
        $id = $row["student_number"];
        $student_id = $row["student_id"];
        $password_student = $row["password_student"];
        $original_passwordpart1 = substr($password_student, 11, 4);
        $original_passwordpart2 = substr($password_student, 19, 3);
        $original_password = $original_passwordpart1 . $original_passwordpart2;

        $Fname = str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $row["Fname"]);
        $Lname = str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $row["Lname"]);
        $Mname = str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $row["Mname"]);
        $Suffix = strtoupper(str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $row["suffix"]));
        $MiddleInitialOnly = strtoupper(getMiddleNameInitials(str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $Mname)));

        if($Suffix != ""){
            $fullname_student = $Lname .', '. $Fname .' '.$Suffix.' '. $MiddleInitialOnly .'.';
        } else {
            $fullname_student = $Lname .', '. $Fname .' '. $MiddleInitialOnly .'.';
        }

        $cysg = $row["cysg"];
        $status = $row["status"];
        $account = $row["account"];

        //<td>" . $original_password . "</td>
        echo "<tr>
            <td>" . $student_id . "</td>
            <td>" . $original_password . "</td>
            <td>" . $fullname_student . "</td>
            <td>" . $cysg . "</td>
            <td>" . $status . "</td>
            <td>" . $account . "</td>
            <td>
                <div class='button'>
                    <a id='colorwayone' href='./index.php?id=" . $id . "'>
                        <img src='./assets/more.png' alt=''>
                        <h4>Edit</h4>
                    <a>
                    <a id='colorwaytwo' href='#' data-id='$id' onclick='prepareStudentRemoval(event);'>
                        <img src='./assets/remove.png' alt=''>
                        <h4>Remove</h4>
                    <a>
                </div>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='8' style='padding: 10%'>No Records Found</td></tr>";
}

// Pagination links
echo "<div class='pagination'>";

if ($totalPages > 1) {
    echo ($currentPage > 1) ? "<a href='?page=" . ($currentPage - 1) . "'>&laquo; Previous</a>" : '';

    for ($i = max(1, $currentPage - 4); $i <= min($totalPages, $currentPage + 4); $i++) {
        echo "<" . (($i == $currentPage) ? "span class='active'>" : "a href='?page=$i'>") . "$i</" . (($i == $currentPage) ? "span" : "a") . ">";
    }

    echo ($currentPage < $totalPages) ? "<a href='?page=" . ($currentPage + 1) . "'>Next &raquo;</a>" : '';
}

echo "</div>";
