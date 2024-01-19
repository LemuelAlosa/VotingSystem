<?php
include 'checker.php';
include_once './connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['partylistname'])) {

        $candidatepartylist = $_SESSION['candidatePartylist'];
        $partylistteam = $_POST['partylistname'];

        $sql = "SELECT * FROM `$candidatepartylist`";
        $result = $conn->query($sql); // I assume $conn is your database connection

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $partyliststored = strtolower(trim($row["partylist"]));
                $partylist = strtolower(trim($partylistteam));

                if ($partyliststored == $partylist) {
                    echo 'AlreadyExist';
                } else {
                    // Didn't Exist
                }
            }
        } else {
            // No rows found, handle accordingly
        }

    }
}
exit();