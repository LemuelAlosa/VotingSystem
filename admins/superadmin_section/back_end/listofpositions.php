<?php
//include 'checker.php';
include_once 'connection.php';

// Query with LIMIT and OFFSET for pagination
$candidateposition = $_SESSION['candidatePosition'];

$sql = "SELECT * FROM `$candidateposition`";
$result = $conn->query($sql);
$numbering = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $numbering++;
        // Access the individual fields from the database and display them
        $id = $row["id"];
        $position = $row["position"];
        

        echo "<tr>
            <td>" . $numbering . "</td>
            <td>" . $position . "</td>
            <td>
                <div class='button'>
                    <a id='colorwaytwo' href='#' data-id='$id' onclick='preparePositionRemoval(event);'>
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