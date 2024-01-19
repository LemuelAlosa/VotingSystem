<?php
//include 'config.php';
include 'checker.php';
include_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['batchselected'])) {

    $currentbatch = $_POST['batchselected'];
    $_SESSION['Batch'] = $currentbatch;

    function extractYearFromBatch($batch) {
        if (preg_match('/\d{4}-\d{4}/', $batch, $matches)) {
            return $matches[0]; 
        } else {
            return "";
        }
    }

    $_SESSION['currentBatch'] = extractYearFromBatch($currentbatch);

    $sql = "UPDATE lsc_election_list SET status = 'deactivated'";
    $result = $conn->query($sql);

    if ($result) {
        $sql = "UPDATE lsc_election_list SET status = 'activated' WHERE lscbatch_list = '$currentbatch'";
        $result = $conn->query($sql);

        if ($result) {
            echo "Successfully updated records.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // May problema sa unang query
        echo "Error: " . $conn->error;
    }

    header("Location: ../index.php");
    exit();
}

?>