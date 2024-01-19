<?php
include_once 'connection.php';

$sql = "SELECT * FROM `lsc_election_list` WHERE status = 'activated'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rowactivated = $result->fetch_assoc();
    $audittrailReport = $rowactivated["audittrial_report"];

    $sqlreport = "SELECT * FROM `$audittrailReport` ORDER BY id DESC";
    $resultReport = $conn->query($sqlreport);

    if ($resultReport->num_rows > 0) {
        $num = 0;
        while ($row = $resultReport->fetch_assoc()) {
            // Access the individual fields from the database and display them
            $num++;
            $id = $row["id"];
            $reports = $row["reports"];
            $account = $row["account"];
            $date = $row["date/time"];

            echo "<tr>
                <td>" . $num . "</td>
                <td colspan=2>" . $reports . "</td>
                <td>" . $account . "</td>
                <td>" . $date . "</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='5' style='padding: 10%'>No Records Found</td></tr>";
    }
}
