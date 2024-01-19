<?php
include_once './back_end/checker.php';
include_once './back_end/connection.php';
include './back_end/defaultbatch.php';
include './back_end/count_students.php';
$sql = "SELECT * FROM `lsc_election_list` WHERE status = 'activated'";
$resultDB = $conn->query($sql);

// Check if a row was returned from 'admins' table
if ($resultDB->num_rows === 1) {
    $rowDB = $resultDB->fetch_assoc();
    $studentstoredbatch = $rowDB["students_batch"];
    $candidatestoredbatch = $rowDB["candidate_batch"];
    $candidatestoredposition = $rowDB["candidate_position"];
    $storedbatch = $rowDB["lscbatch_list"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="./images/LSC_Logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="result.css">
    <title>Live Results</title>
</head>

<body>
    <header>
        <div class="logo"><a href="index.php"><img src="./images/BSUHagonoyandLSC-Logo.png" alt=""></a></div>
        <div class="text">
            <h1>Bulacan State University</h1>
            <h4>Hagonoy Bulacan</h4>
            <h5><span>Student Government -&nbsp;</span>Local Student Council</h5>
        </div>
    </header>
    <div id="background-header-1"></div>
    <div id="background-header-2"></div>
    <div id="background-image"></div>
    <div class="main">
        <div class="section1">
            <div class="section1-left">
                <h2>Students</h2>
            </div>
            <div class="section1-right">
                <h2>Live Results...</h2>
                <div id="colorway1" onclick="LogoutNow();">
                    <img src="./assets/logout.png" alt="">
                    <h3>Logout</span></h3>
                </div>
            </div>
        </div>
        <div id="section1-line"></div>
        <div class="section2">
            <h2>Candidate Results for
                <?php echo $storedbatch; ?>
            </h2>
        </div>
        <div class="section3">
            <div class="section3-mid" id="fullscreenContainer">
                <div class="slider">
                    <div class="slides">
                        <?php
                        $sql_search = "SELECT * FROM `$candidatestoredposition`";
                        $result_outer = $conn->query($sql_search);

                        $slideNum = 0;
                        $vChartNum = 0;

                        if ($result_outer->num_rows > 0) {
                            while ($rowstored = $result_outer->fetch_assoc()) {
                                $position = strtoupper($rowstored["position"]);
                                $slideNum++;
                                $vChartNum++;

                                echo '<div class="slide-' . $slideNum . '">
                                            <div class="div-left">
                                                <h3 id="resultPosition">' . $position . '</h3>
                                            </div>
                                            <div class="div-right">';

                                if (isset($_SESSION['Batch'])) {
                                    $currentBatch = $_SESSION['currentBatch'];
                                    $sql_votes = "SELECT * FROM `candidate_batch$currentBatch` WHERE Position = '$position' ORDER BY votes DESC";
                                } else {
                                    $defaultBatch = $_SESSION['defaultBatch'];
                                    $sql_votes = "SELECT * FROM `candidate_batch$defaultBatch` WHERE Position = '$position' ORDER BY votes DESC";
                                }
                                $resultvotes = $conn->query($sql_votes);

                                // Create an associative array to store the results
                                $data = array();

                                while ($row = $resultvotes->fetch_assoc()) {
                                    $fullname_candidate = '';
                                    $Fname = $row["Firstname_candidate"];
                                    $Lname = $row["Lastname_candidate"];
                                    $Mname = substr($row["Middlename_candidate"], 0, 1);
                                    $Suffix = strtoupper($row["suffix"]);

                                    // Truncate long first names if they are too long (e.g., limit to a certain number of characters)
                                    $maxFirstNameLength = 10; // You can adjust this value as needed
                        
                                    if (strlen($Fname) > $maxFirstNameLength) {
                                        $Fname = substr($Fname, 0, $maxFirstNameLength) . '...';
                                    }

                                    if ($Mname != "") {
                                        if ($Suffix != "") {
                                            $fullname_candidate = $Lname . ', ' . $Fname . ' ' . $Suffix . ' ' . $Mname . '.';
                                        } else {
                                            $fullname_candidate = $Lname . ', ' . $Fname . ' ' . $Mname . '.';
                                        }
                                    } else {
                                        $fullname_candidate = $Lname . ', ' . $Fname;
                                    }
                                    $data[$fullname_candidate] = $row['votes'];
                                }

                                echo '<div style="width: 900px; height: 700px; position: relative;">
                                                    <canvas id="votingChart' . $vChartNum . '" class="chart-canvas"></canvas>
                                                  </div>';

                                echo "
                                            <script>
                                                // Retrieve the data from PHP and create a pie chart
                                                var data = " . json_encode($data) . "; // Data retrieved from PHP
        
                                                // Format the labels with vote counts
                                                var formattedLabels = Object.keys(data).map(function (label) {
                                                    var votes = data[label];
                                                    var invisibleSpaces = '';
        
                                                    // Adjust the number of invisible spaces based on the length of the label
                                                    if (label.length < 20) {
                                                        var numSpacesToAdd = 33 - label.length;
                                                        invisibleSpaces = ' '.repeat(numSpacesToAdd);
                                                    }
        
                                                    return label + ' (' + votes + ' votes)' + invisibleSpaces;
                                                });
        
                                                var ctx = document.getElementById('votingChart" . $vChartNum . "').getContext('2d');
                                                var votingChart" . $vChartNum . " = new Chart(ctx, {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: formattedLabels, // Candidate names with vote counts
                                                        datasets: [{
                                                            data: Object.values(data), // Vote counts
                                                            backgroundColor: [
                                                                '#006400',
                                                                '#D9A217',
                                                                '#C7D36F',
                                                                '#AA0D0D',
                                                                '#004300',
                                                                // Add more colors as needed
                                                            ],
                                                        }],
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        cutout: '70%',
                                                        plugins: {
                                                            legend: {
                                                                position: 'left',
                                                                labels: {
                                                                    // This more specific font property overrides the global property
                                                                    font: {
                                                                        size: 20
                                                                    },
                                                                    padding: 20,
                                                                    color: 'black'
                                                                }
                                                            }
                                                        },
                                                        layout: {
                                                            padding: {
                                                                right: -400
                                                            }
                                                        }
                                                    }
                                                });
                                            </script>
                                            ";

                                echo '</div>
                                    </div>';

                            }
                        }
                        ?>
                    </div>
                    <div class="backgroundresult"></div>
                </div>
                <div class="arrow-container">
                    <div class="arrow-left"></div>
                    <div class="indicator-container">
                        <?php
                        $sql_dot = "SELECT * FROM `$candidatestoredposition`";
                        $result_dot = $conn->query($sql_dot);

                        if ($result_dot->num_rows > 0) {
                            while ($rowstoreddot = $result_dot->fetch_assoc()) {
                                $position = strtoupper($rowstoreddot["position"]);
                                echo '<div class="indicator-dot"></div>';
                            }
                        }
                        ?>
                    </div>
                    <div class="arrow-right"></div>
                </div>
            </div>
        </div>
        <div class="section4-table">
                <?php
                $sql_result = "SELECT * FROM `$candidatestoredposition`";
                $result_tally = $conn->query($sql_result);

                if ($result_tally->num_rows > 0) {
                    while ($rowstoreddot = $result_tally->fetch_assoc()) {
                        $position = strtoupper($rowstoreddot["position"]);
                        echo '
                                    <table>
                                    <thead>
                                        <tr>
                                            <th id="col1">Candidate for ' . $position . '</th>
                                            <th>Images</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                ';

                        if (isset($_SESSION['Batch'])) {
                            $currentBatch = $_SESSION['currentBatch'];
                            $sql_votes = "SELECT * FROM `candidate_batch$currentBatch` WHERE Position = '$position' ORDER BY votes DESC";
                        } else {
                            $defaultBatch = $_SESSION['defaultBatch'];
                            $sql_votes = "SELECT * FROM `candidate_batch$defaultBatch` WHERE Position = '$position' ORDER BY votes DESC";
                        }
                        $resultvotes = $conn->query($sql_votes);

                        if ($resultvotes->num_rows > 0) {
                            while ($row = $resultvotes->fetch_assoc()) {
                                $fullname_cand = '';
                                $Fname = $row["Firstname_candidate"];
                                $Lname = $row["Lastname_candidate"];
                                $Mname = substr($row["Middlename_candidate"], 0, 1);
                                $Suffix = strtoupper($row["suffix"]);
                                $image = $row["Image"];
                                $votes = $row["votes"];

                                if ($Mname != "") {
                                    if ($Suffix != "") {
                                        $fullname_cand = $Lname . ', ' . $Fname . ' ' . $Suffix . ' ' . $Mname . '.';
                                    } else {
                                        $fullname_cand = $Lname . ', ' . $Fname . ' ' . $Mname . '.';
                                    }
                                } else {
                                    $fullname_cand = $Lname . ', ' . $Fname;
                                }

                                echo '
                                            <tr?>
                                            <td id="col1">' . $fullname_cand . '</td>
                                            <td><img src="../admins/admin_section/candidates_images/' . $image . '" alt=""></td>
                                            <td><h3 id="votes">' . $votes . '</h3></td>
                                            </tr>
                                        ';
                            }
                        } else {
                            echo '<tr>
                                        <td colspan="3">No Candidate...</td>
                                    </tr>';
                        }
                        echo '
                                    </tbody>
                                </table>
                                ';
                    }
                }
                ?>
            </div>




        <div class="error404">
            <div class="error404-Top">
                <div class="error404-Top1">
                    <h1 id="txt1">Oppss!!!</h1>
                    <h1 id="txt2">#404</h1>
                </div>
                <div class="error404-Top2">
                    <img id="img1" src="./assets/404.png" alt="">
                </div>
            </div>
            <div class="error404-Bottom">
                <h1 class="txt3">This website is not<br> available with your device</h1>
                <h1 class="txt4">Make sure your display resolution is 1280 width+</h1>
            </div>
        </div>


        <script src="result.js"></script>
</body>

</html>