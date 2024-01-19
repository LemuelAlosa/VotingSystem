<?php
include 'connection.php';

function getBatchYear($conn) {
    $sql = "SELECT * FROM lsc_election_list ORDER BY lscbatch_id DESC"; // Ascending order ang pagkuha
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $lscbatch_list = $row['lscbatch_list'];

            if (preg_match('/\d{4}-\d{4}/', $lscbatch_list, $matches)) {
                return $matches[0];
            }
        }
    }

    return "";
}
$_SESSION['defaultBatch'] = getBatchYear($conn);