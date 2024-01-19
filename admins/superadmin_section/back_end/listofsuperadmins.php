<?php
//include 'checker.php';
include_once 'connection.php';

// Query with LIMIT and OFFSET for pagination

$sql = "SELECT * FROM `super_admin` WHERE status='activated' OR status='deactivated'";
$result = $conn->query($sql);
$numbering = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $numbering++;
        // Access the individual fields from the database and display them
        $id = $row["superadmin_Id"];
        $useradmin_admin = $row["username_superadmin"];
        $password_admin = $row["password_superadmin"];
        $status = $row["status"];

        echo "<tr>
            <td>" . $numbering . "</td>
            <td>" . $useradmin_admin . "</td>
            <td> ??? </td>
            <td>" . $status . "</td>
            <td>
                <div class='button'>
                    <a id='colorwaytwo' href='#' data-id='$id' onclick='prepareSuperadminRemoval(event);'>
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