<?php
//include './back_end/config.php';
include './back_end/checker.php';
include_once './back_end/connection.php';
include './back_end/defaultbatch.php';
include './back_end/count_students.php';

// echo $_SESSION['defaultBatch'];
// echo $_SESSION['Batch'];
// echo $_SESSION['currentBatch'];

$sql_batch = "SELECT * FROM `lsc_election_list` WHERE status = 'activated'";
$result = $conn->query($sql_batch);
if ($result->num_rows > 0) {
    $rowactivated = $result->fetch_assoc();
    $lscbatch = $rowactivated["lscbatch_list"];
    $_SESSION["current_batch"] = $lscbatch;
    $candidatebatch = $rowactivated["candidate_batch"];
    $_SESSION['CandidateBatch'] = $candidatebatch;
    $candidateposition = $rowactivated["candidate_position"];
    $_SESSION['candidatePosition'] = $candidateposition;
    $candidatepartylist = $rowactivated["candidate_partylist"];
    $_SESSION['candidatePartylist'] = $candidatepartylist;
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
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
    <link rel="stylesheet" href="superadmin.css">
    <title>Superadmin</title>
</head>

<body>
    <header>
        <div class="logo"><a href="index.php"><img src="./images/BSUHagonoyandLSC-Logo.png" alt=""></a></div>
        <div class="text">
            <h1>Bulacan State University</h1>
            <h4>Hagonoy Bulacan</h4>
            <h5>Student Government - Local Student Council</h5>
        </div>
    </header>
    <div id="background-header-1"></div>
    <div id="background-header-2"></div>
    <div class="main">
        <nav>
            <h2>MENU</h2>
            <div class="nav1" id="nav1">
                <div class="nav1-left">
                    <img src="./assets/List.png" alt="">
                    <h3> Voters List</h3>
                </div>
                <div class="nav1-right">
                    <img src="./assets/lessthan.png" alt="">
                </div>
            </div>
            <!-- <div class="nav2" id="nav2">
                <div class="nav2-left">
                    <img src="./assets/votedlist.png" alt="">
                    <h3> Voted List</h3>
                </div>
                <div class="nav2-right">
                    <img src="./assets/lessthan.png" alt="">
                </div>
            </div> -->
            <div class="nav4" id="nav4">
                <div class="nav4-left">
                    <img src="./assets/votedlist.png" alt="">
                    <h3> Candidates List</h3>
                </div>
                <div class="nav4-right">
                </div>
            </div>
            <div class="nav3" id="nav3">
                <div class="nav3-left">
                    <img src="./assets/canvassingreport.png" alt="">
                    <h3> Canvassing Report</h3>
                </div>
                <div class="nav3-right">
                </div>
            </div>
            <div class="nav5" id="nav5">
                <div class="nav5-left">
                    <img src="./assets/allvoters.png" alt="">
                    <h3> Audit Trail Reports</h3>
                </div>
                <div class="nav5-right">
                </div>
            </div>
            <br>
            <h2 id="electiondetailsnavigation">Election Details<img src="./assets/lessthan.png" id="elecdetails" alt="">
            </h2>
            <form action="./back_end/current_batch.php" id="myForm8" method="post" enctype="multipart/form-data">
                <div class="electiondetailsnav">
                    <div id="dropbox">
                        <img src="./assets/List.png" alt="">
                        <select name="batchselected">
                            <?php
                            include_once './back_end/connection.php';
                            $sql = "SELECT * FROM lsc_election_list ORDER BY lscbatch_id DESC";
                            if (isset($_SESSION['Batch'])) {
                                $currentBatch = $_SESSION['Batch'];
                                echo "<option value='$currentBatch'>$currentBatch</option>";
                            }
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $lscbatch_list = $row['lscbatch_list'];
                                    if ($lscbatch_list == $_SESSION['Batch']) {
                                        continue;
                                    }

                                    echo "<option value='$lscbatch_list'>$lscbatch_list</option>";
                                }
                            } else {
                                echo "<option value=''>No Database Yet</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <h4 id="elecmoreinfo" onclick="ElectionInformationBack();">More Information</h4>
                    <button id="proceed" type="submit">
                        <img src="./assets/sendpassword.png" alt="">
                        <h3> Proceed</h3>
                    </button>
                    <div class="newelectionevent">
                        <img src="./assets/newelectionevent.png" alt="">
                        <h3> New Election Event</h3>
                    </div>
                </div>
            </form>
            <br>
            <h2 id="adminnav">Accounts<img src="./assets/lessthan.png" id="admin" alt=""></h2>
            <div class="administrator">
                <div class="adminnav">
                    <div class="adminnav-left" onclick="newadmin();">
                        <img src="./assets/newadmin.png" alt="">
                        <h3> New Admin</h3>
                    </div>
                    <div class="adminnav-right">
                    </div>
                </div>
                <div class="adminnav">
                    <div class="adminnav-left" onclick="ListOfAdmin();">
                        <img src="./assets/List.png" alt="">
                        <h3> List of Admins</h3>
                    </div>
                    <div class="adminnav-right">
                    </div>
                </div>
                <div class="adminnav">
                    <div class="adminnav-left" id="activate_deactivateadmins">
                        <img src="./assets/activateadmin.png" id="adminactivate" alt="">
                        <img src="./assets/deactivateadmin.png" id="admindeactivate" alt="">
                        <h3 id=adminStatusDisplay></h3>
                    </div>
                    <div class="adminnav-right">
                    </div>
                </div>
                <div id="line"></div>
                <div class="superadminnav">
                    <div class="superadminnav-left" onclick="supernewadmin();">
                        <img src="./assets/newadmin.png" alt="">
                        <h3> New Superadmin</h3>
                    </div>
                    <div class="superadminnav-right">
                    </div>
                </div>
                <div class="superadminnav">
                    <div class="superadminnav-left" onclick="ListOfSuperdmin();">
                        <img src="./assets/List.png" alt="">
                        <h3> List of Superadmins</h3>
                    </div>
                    <div class="superadminnav-right">
                    </div>
                </div>
                <div class="superadminnav">
                    <div class="superadminnav-left" id="activate_deactivatesuperadmins">
                        <img src="./assets/activateadmin.png" id="superadminactivate" alt="">
                        <img src="./assets/deactivateadmin.png" id="superadmindeactivate" alt="">
                        <h3 id=superadminStatusDisplay></h3>
                    </div>
                    <div class="superadminnav-right">
                    </div>
                </div>
            </div>
            <div class="navfooter" onclick="logout();">
                <div class="navfooter-left">
                    <img src="./assets/logout.png" alt="">
                    <h3> Logout</h3>
                </div>
                <div class="navfooter-right">
                </div>
            </div>
        </nav>
        <section>
            <div class="section1">
                <h2>
                    <?php if (isset($_SESSION['Batch'])) {
                        echo $_SESSION['Batch'];
                    } else {
                        echo "LSCBatch$_SESSION[defaultBatch]";
                    } ?>
                </h2>
                <div class="right-side">
                    <div id="colorway1">
                        <img src="./assets/allvoters.png" alt="">
                        <h3>All Voters <span>(<?php echo $totalVoters; ?>)</span></h3>
                    </div>
                    <div id="colorway5">
                        <img src="./assets/voted.png" alt="">
                        <h3>Voted <span>(<?php echo $totalVoted; ?>)</span></h3>
                    </div>
                    <div id="colorway3">
                        <img src="./assets/unvoted.png" alt="">
                        <h3>Unvoted <span>(<?php echo $totalUnvoted; ?>)</span></h3>
                    </div>
                </div>
            </div>
            <div id="section1-line"></div>
            <div class="section2">
                <div class="left-side">
                    <div id="colorway5"
                        onclick="downloadFile('./ExcelVoterTemplate/RegistrationTemplateForStudent.xlsx','RegistrationTemplateForStudent')">
                        <img src="./assets/downloadexcel.png" alt="">
                        <h3>Download <span>(excel template)</span></h3>
                    </div>
                </div>
                <div class="right-side">
                    <div id="colorway5" onclick="SendPassword();">
                        <img src="./assets/sendpassword.png" alt="">
                        <h3>Send All Password <span>(via Email)</span></h3>
                    </div>
                    <!-- <div id="colorway4" onclick="DownloadDB();">
                        <img src="./assets/databaseexport.png" alt="">
                        <h3>Database <span>(Download)</span></h3>
                    </div> -->
                </div>
            </div>
            <div class="section3">
                <div class="left-side">
                    <div id="colorway4" onclick="uploadExcelFile();">
                        <img src="./assets/importexcel.png" alt="">
                        <h3>Import Data <span>(excel file)</span></h3>
                    </div>
                </div>
                <div class="right-side">
                    <div id="colorway4" class="changestatusVoters">
                        <img src="./assets/activiteallvoters.png" alt="">
                        <h3 id=studentStatusDisplay></h3>
                    </div>
                    <div id="colorway5" onclick="generatePassword();">
                        <img src="./assets/generatepassword.png" alt="">
                        <h3>Generate Voters Password</h3>
                    </div>
                </div>
            </div>
            <div class="section4">
                <h2>Voters List</h2>
                <div>
                    <div class="searchBar">
                        <label for="student_id">Search Student ID: </label>
                        <div>
                            <input type="number" name="student_id" id="student_id" oninput="searchStudent();">
                            <img id="searchimg" src="./assets/searchtab.png" alt="">
                        </div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Password</th>
                            <th>FullName</th>
                            <th>CYSG</th>
                            <th>Status</th>
                            <th>Account</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        <?php include './back_end/voters_list.php'; ?>
                    </tbody>
                </table>
            </div>
            <!-- <div class="section5">
                <h2>Voted List</h2>
                <div>
                    <div class="searchBar">
                        <label for="voter_id">Voter No: </label>
                        <div>
                            <input type="number" name="voter_id" id="voter_id" oninput="searchStudentVoted();">
                            <img id="searchimg" src="./assets/searchtab.png" alt="">
                        </div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>CYSG</th>
                            <th>Student_ID</th>
                            <th>Governor</th>
                            <th>Vice Governor</th>
                            <th>BM Tourism</th>
                            <th>BM Education</th>
                            <th>BM IT</th>
                            <th>BM HM/BIT</th>
                        </tr>
                    </thead>
                    <tbody id="studentVotedTableBody">
                        <?php //include './back_end/voted_list.php'; ?>
                    </tbody>
                </table>
            </div> -->
            <div class="section6">
                <h2>Canvassing Report</h2>
                <div class="section6-top">
                    <div>
                        <h1>Live Results...</h1>
                    </div>
                    <div id="colorway5" onclick="VoteTallyReport();">
                        <img src="./assets/print.png" alt="">
                        <h3>Print Now</h3>
                    </div>
                </div>
                <div class="section6-mid" id="fullscreenContainer">
                    <div class="slider">
                        <div class="slides">
                            <?php
                            $sql_search = "SELECT * FROM `$candidateposition`";
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
                    </div>
                    <div class="backgroundresult"></div>
                </div>
                <div class="arrow-container">
                    <div class="arrow-left"></div>
                    <div class="indicator-container">
                        <?php
                        $sql_dot = "SELECT * FROM `$candidateposition`";
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

                <!-- <img src="assets/fullscreen.png" id="fullscreen" onclick="toggleFullscreen()"> -->
                <div class="section6-table">

                    <?php
                    $sql_result = "SELECT * FROM `$candidateposition`";
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
                                            <td><img src="../admin_section/candidates_images/' . $image . '" alt=""></td>
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
            </div>
            <div class="section7">
                <h2>Candidates for
                    <?php echo $_SESSION["current_batch"]; ?>
                </h2>
                <div class="section7-top">
                    <div class="section7-left">
                        <select name="position" id="position" oninput="filterCandidates()">
                            <?php
                            $sql = "SELECT * FROM `$candidateposition`";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo '<option value="All">All</option>';
                                while ($row = $result->fetch_assoc()) {
                                    $position = $row["position"];
                                    echo '<option value="' . $position . '">' . $position . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <h3>Position</h3>

                        <select name="partylist" id="partylist" oninput="filterCandidates()">
                            <?php
                            $sql = "SELECT * FROM `$candidatepartylist`";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo '<option value="All">All</option>';
                                while ($row = $result->fetch_assoc()) {
                                    $partylist = $row["partylist"];
                                    echo '<option value="' . $partylist . '">' . $partylist . '</option>';
                                }
                                echo '<option value="None">None</option>';
                            }
                            ?>
                        </select>
                        <h3>PartyList</h3>
                    </div>
                    <div class="section7-right">
                        <div class="div1">
                            <div class="section7-right4" onclick="ListOfPositions();">
                                <img src="" alt="">
                                <h3>List of Position</h3>
                            </div>
                            <div class="section7-right5" onclick="ListOfPartylist();">
                                <img src="" alt="">
                                <h3>List of PartyList</h3>
                            </div>
                        </div>
                        <div class="div2">
                            <div class="section7-right1" onclick="addcandidate();">
                                <img src="" alt="">
                                <h3>Add Candidates</h3>
                            </div>
                            <div class="section7-right2" onclick="addposition();">
                                <img src="" alt="">
                                <h3>Add Position</h3>
                            </div>
                            <div class="section7-right3" onclick="addpartylist();">
                                <img src="" alt="">
                                <h3>Add PartyList</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section7-main">
                    <table>
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>PartyList</th>
                                <th>Fullname</th>
                                <th>Yearlevel</th>
                                <th>Course</th>
                                <th>Gender</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="candidateTableBody"></tbody>
                    </table>
                </div>
            </div>
            <div class="section8">
                <h2>Audit Trail Reports</h2>
                <div class="section8-main">
                    <table>
                        <thead>
                            <tr>
                                <th>Num#</th>
                                <th colspan=2>Reports</th>
                                <th>Account</th>
                                <th>Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include './back_end/audittrial_reports.php' ?>
                        </tbody>
                    </table>
                </div>
            </div>













            <!-- EXTRASTTTTTTTTTTTTTTTT -->
            <div class="print_votetally">
                <div class="print_votetally-blackbackground" onclick=""></div>
                <div class="print_votetally-background">
                    <form action="./back_end/insert_fullnameofsuperadminsAndadmins.php" id="myForm13" method="post"
                        enctype="multipart/form-data" onsubmit="VoteTallyReportNow();">
                        <h2>VoteTally Report for 
                            <?php echo $_SESSION["current_batch"]; ?>
                        </h2>
                        <div class="line"></div>
                        <div><h3>Enter the Fullname of the Person who handle this accounts:</h3></div>
                        <div class="print_votetally-main">
                            <div class="print_votetally-left">
                                <?php
                                $sql_search1 = "SELECT * FROM `super_admin` WHERE status='activated' OR status='deactivated'";
                                $result_outer1 = $conn->query($sql_search1);
                                
                                $superadmincount = 0; 
                                
                                if ($result_outer1->num_rows > 0) {
                                    while ($rowstored = $result_outer1->fetch_assoc()) {
                                        $s_username = $rowstored["username_superadmin"];
                                        $superadmincount++;
                                        echo'
                                        <br>
                                        <label for="superadmin'.$superadmincount.'">Fullname ('.$s_username.') </label>
                                        <input type="text" name="superadmin'.$superadmincount.'" id="" placeholder="Enter The FullName Here..." autocomplete="off" required>
                                        ';
                                    }
                                }
                                ?>
                                <br>
                            </div>
                            <div class="print_votetally-right">
                            <?php
                                $sql_search2 = "SELECT * FROM `admins`";
                                $result_outer2 = $conn->query($sql_search2);
                                
                                $admincount = 0; 
                                
                                if ($result_outer2->num_rows > 0) {
                                    while ($rowstored = $result_outer2->fetch_assoc()) {
                                        $a_username = $rowstored["username_admin"];
                                        $admincount++;
                                        echo '
                                        <br>
                                        <label for="admin'.$admincount.'">Fullname ('.$a_username.') </label>
                                        <input type="text" name="admin'.$admincount.'" id="" placeholder="Enter The FullName Here..." autocomplete="off" required>
                                        ';
                                    }
                                }
                                ?>
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="print_votetally-footer">
                            <input type="submit" value="Print Now">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ListofPartyList">
                <div class="ListofPartyList-blackbackground"></div>
                <div class="ListofPartyList-background">
                    <h2>List of Position for Candidates</h2>
                    <div class="line"></div>
                    <div class="ListofPartyList-main">
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>PartyList Teams</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include './back_end/listofpartylist.php'; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="line"></div>
                    <div class="ListofPartyList-footer">
                        <h4>Close</h4>
                    </div>
                    </form>
                </div>
            </div>
            <div class="addpartylist_candidate">
                <div class="addpartylist_candidate-blackbackground" onclick=""></div>
                <div class="addpartylist_candidate-background">
                    <form action="./back_end/addnew_partylist.php" id="myForm12" method="post"
                        enctype="multipart/form-data" onsubmit="addnowpartylist();">
                        <h2>Add New PartyList on
                            <?php echo $_SESSION["current_batch"]; ?>
                        </h2>
                        <div class="line"></div>
                        <div class="addpartylist_candidate-main">
                            <div class="addpartylist_candidate-left">
                                <br>
                                <label for="partylistname">PartyList Team: </label>
                                <input type="text" name="partylistname" id="partylistname"
                                    placeholder="Enter The PartyList Team Here..." autocomplete="off" required>
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="addpartylist_candidate-footer">
                            <input type="submit" value="Add Now">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ListofPositions">
                <div class="ListofPositions-blackbackground"></div>
                <div class="ListofPositions-background">
                    <h2>List of Position for Candidates</h2>
                    <div class="line"></div>
                    <div class="ListofPositions-main">
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Positions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include './back_end/listofpositions.php'; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="line"></div>
                    <div class="ListofPositions-footer">
                        <h4>Close</h4>
                    </div>
                    </form>
                </div>
            </div>
            <div class="addposition_candidate">
                <div class="addposition_candidate-blackbackground" onclick=""></div>
                <div class="addposition_candidate-background">
                    <form action="./back_end/addnew_position.php" id="myForm11" method="post"
                        enctype="multipart/form-data" onsubmit="addnowposition();">
                        <h2>Add New Position on
                            <?php echo $_SESSION["current_batch"]; ?>
                        </h2>
                        <div class="line"></div>
                        <div class="addposition_candidate-main">
                            <div class="addposition_candidate-left">
                                <br>
                                <label for="position">Position</label>
                                <input type="text" name="position" id="position"
                                    placeholder="Enter The New Position Here..." autocomplete="off" required>
                                <br>
                                <span>Tips: Highest position first if you want to add new position</span>
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="addposition_candidate-footer">
                            <input type="submit" value="Add Now">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="addcandidates-blackbackground"></div>
            <div class="addcandidates-background">
                <form action="./back_end/back_end.php" id="myForm10" method="post" enctype="multipart/form-data">
                    <h2>Add Candidates</h2>
                    <div id="line"></div>
                    <div class="addcandidates-main">
                        <div class="addcandidates-left">
                            <label for="position">Position</label>
                            <select name="position" id="position">
                                <?php
                                $sql = "SELECT * FROM `$candidateposition`";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $position = $row["position"];
                                        echo '<option value="' . $position . '">' . $position . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <br>
                            <label for="partylist">PartyList</label>
                            <select name="partylist" id="partylist">
                                <?php
                                $sql = "SELECT * FROM `$candidatepartylist`";
                                $result = $conn->query($sql);

                                echo '<option value="None">None</option>';
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $partylist = $row["partylist"];
                                        echo '<option value="' . $partylist . '">' . $partylist . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <br>
                            <div class="div1">
                                <div class="div1-left">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" id="firstname"
                                        placeholder="Enter Firstname here..." autocomplete="off" required>
                                </div>
                                <div class="div1-right">
                                    <label for="middlename">Middlename</label>
                                    <input type="text" name="middlename" id="middlename"
                                        placeholder="Enter Middlename here..." value="" autocomplete="off">
                                </div>
                            </div>
                            <div>
                            </div>
                            <br>
                            <div class="div1">
                                <div class="div1-left">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="lastname"
                                        placeholder="Enter Lastname here..." autocomplete="off" required>
                                </div>
                                <div class="div1-right">
                                    <label for="suffix">Suffix (eg. jr, ii, iii, iv)</label>
                                    <input type="text" name="suffix" id="suffix" placeholder="Enter Suffix here..."
                                        value="" autocomplete="off">
                                </div>
                            </div>
                            <br>
                            <label for="yearlevel">Yearlevel</label>
                            <select name="yearlevel" id="yearlevel">
                                <option value="4th">4th Year</option>
                                <option value="3rd">3rd Year</option>
                                <option value="2nd">2nd Year</option>
                                <option value="1st">1st Year</option>
                            </select>
                            <br>
                            <label for="course">Course</label>
                            <select name="course" id="course">
                                <option value="BSIT">Bachelor of Science in Information Technology</option>
                                <option value="BSHM">Bachelor of Science in Hospitality Management</option>
                                <option value="BSTM">Bachelor of Science in Tourism Management</option>
                                <option value="BEED">Bachelor in Elementary Education</option>
                                <option value="BSED">Bachelor in Secondary Education</option>
                                <option value="BTLED">Bachelor in Technology and Livelihood Education</option>
                                <option value="BIT">Bachelor in Industrial Technology</option>
                            </select>
                        </div>
                        <div id="line-portrait"></div>
                        <div class="addcandidates-right">
                            <label for="image">Image</label>
                            <input type="file" name="imagescandidates" id="imagescandidates" accept=".jpg, .jpeg, .png"
                                required>
                            <br>
                            <label for="">Gender</label>
                            <div>
                                <input type="radio" id="genderM" name="gender" value="Male" required>
                                <label id="genderfont" for="gender">Male</label>
                                <input type="radio" id="genderF" name="gender" value="Female" required>
                                <label id="genderfont" for="gender">Female</label>
                            </div>
                            <br>
                            <label for="missionstatement">Mission Statement</label>
                            <textarea id="missionstatement" name="missionstatement" rows="11"
                                placeholder="Enter the candidate mission statement here..." required></textarea>
                        </div>
                    </div>
                    <div id="line"></div>
                    <div class="addcandidates-footer">
                        <input type="submit" value="Save Data">
                        <h4>Close</h4>
                    </div>
                </form>
            </div>
            <div class="edit_candidate">
                <?php
                include_once './back_end/connection.php';

                if (isset($_GET['id'])) {
                    $candidateId = $_GET['id'];

                    $Batch = $_SESSION['CandidateBatch'];

                    $sql = "SELECT * FROM `$Batch` WHERE id='$candidateId'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        // Access the individual fields from the database and display them
                        $id = $row["id"];
                        $position = $row["Position"];
                        $partylist = $row["Partylist"];
                        $firstname = $row["Firstname_candidate"];
                        $middlename = $row["Middlename_candidate"];
                        $lastname = $row["Lastname_candidate"];
                        $suffix = strtoupper($row["suffix"]);
                        $yearlevel = $row["Yearlevel"];
                        $course = $row["Course"];
                        $gender = $row["Gender"];
                        $missionstatement = $row["Mission"];
                        $imagecandidatefilename = $row["Image"];

                        echo '<div class="updatecandidates-blackbackground" onclick="editcandidates_close();"></div>
                    <div class="updatecandidates-background">
                        <form action="./back_end/edit_candidate.php?id=' . $id . '" id="myForm10" method="post" enctype="multipart/form-data">
                            <h2>Edit Candidates</h2>
                            <div id="line"></div>
                            <div class="updatecandidates-main">
                                <div class="updatecandidates-left">
                                    <label for="position">Position</label>
                                    <select name="position" id="position">';
                        // Fetch positions from database
                        $sql = "SELECT * FROM `$candidateposition`";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $positionstored = $row["position"];
                                $selected = ($positionstored == $position) ? 'selected' : ''; // Check if it's the desired option
                
                                echo '<option value="' . $positionstored . '" ' . $selected . '>' . $positionstored . '</option>';
                            }
                        }

                        echo '</select>
                                        <br>
                                        <label for="partylist">PartyList</label>
                                        <select name="partylist" id="partylist">';

                        // Fetch partylists from database (replace $candidateposition with the correct table name)
                        $sql = "SELECT * FROM `$candidatepartylist`";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            if ($partylist == 'None') {
                                echo '<option value="None">None</option>';
                            }
                            while ($row = $result->fetch_assoc()) {
                                $partyliststored = $row["partylist"];
                                $selected = ($partyliststored == $partylist) ? 'selected' : ''; // Check if it's the desired option
                
                                echo '<option value="' . $partyliststored . '" ' . $selected . '>' . $partyliststored . '</option>';
                            }
                            if ($partylist != 'None') {
                                echo '<option value="None">None</option>';
                            }
                        }

                        echo '</select>
                                <br>
                                <div class="div1">
                                    <div class="div1-left">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" value="' . $firstname . '" name="firstname" id="firstname" placeholder="Enter Firstname here..." autocomplete="off" required>
                                    </div>
                                    <div class="div1-right">
                                        <label for="middlename">Middlename</label>
                                        <input type="text" value="' . $middlename . '" name="middlename" id="middlename" placeholder="Enter Middlename here..." value="" autocomplete="off">
                                    </div>
                                </div>
                                <div>
                                </div>
                                <br>
                                <div class="div1">
                                    <div class="div1-left">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" value="' . $lastname . '" name="lastname" id="lastname" placeholder="Enter Lastname here..." autocomplete="off" required>
                                    </div>
                                    <div class="div1-right">
                                        <label for="suffix">Suffix (eg. jr, ii, iii, iv)</label>
                                        <input type="text" value="' . $suffix . '" name="suffix" id="suffix" placeholder="Enter Suffix here..." value="" autocomplete="off">
                                    </div>
                                </div>
                                <br>
                                <label for="yearlevel">Yearlevel</label>
                                <select name="yearlevel" id="yearlevel">
                                    <option value="4th"' . ($yearlevel === '4th' ? ' selected' : '') . '>4th Year</option>
                                    <option value="3rd"' . ($yearlevel === '3rd' ? ' selected' : '') . '>3rd Year</option>
                                    <option value="2nd"' . ($yearlevel === '2nd' ? ' selected' : '') . '>2nd Year</option>
                                    <option value="1st"' . ($yearlevel === '1st' ? ' selected' : '') . '>1st Year</option>
                                </select>
                                <br>
                                <label for="course">Course</label>
                                <select name="course" id="course">
                                    <option value="BSIT"' . ($course === 'BSIT' ? ' selected' : '') . '>Bachelor of Science in Information Technology</option>
                                    <option value="BSHM"' . ($course === 'BSHM' ? ' selected' : '') . '>Bachelor of Science in Hospitality Management</option>
                                    <option value="BSTM"' . ($course === 'BSTM' ? ' selected' : '') . '>Bachelor of Science in Tourism Management</option>
                                    <option value="BEED"' . ($course === 'BEED' ? ' selected' : '') . '>Bachelor in Elementary Education</option>
                                    <option value="BSED"' . ($course === 'BSED' ? ' selected' : '') . '>Bachelor in Secondary Education</option>
                                    <option value="BTLED"' . ($course === 'BTLED' ? ' selected' : '') . '>Bachelor in Technology and Livelihood Education</option>
                                    <option value="BIT"' . ($course === 'BIT' ? ' selected' : '') . '>Bachelor in Industrial Technology</option>
                                </select>
                            </div>
                            <div id="line-portrait"></div>
                            <div class="updatecandidates-right">
                                <div class="updatecandidates-right-main">
                                    <div class="updatecandidates-right-left">
                                        <label for="image">Current Image</label><br>
                                        <img src="../admin_section/candidates_images/' . $imagecandidatefilename . '" alt="">
                                    </div>
                                    <div class="updatecandidates-right-right">
                                        <label for="image">Upload New Image?</label><br>
                                        <input type="file" name="imagescandidates" id="imagescandidates" accept=".jpg, .jpeg, .png">
                                    </div>
                                </div>
                                <br>
                                <label for="">Gender</label>
                                <div>
                                    <input type="radio" id="genderM" name="gender" value="Male"' . ($gender === 'Male' ? ' checked' : '') . ' required>
                                    <label id="genderfont" for="gender">Male</label>
                                    <input type="radio" id="genderF" name="gender" value="Female"' . ($gender === 'Female' ? ' checked' : '') . ' required>
                                    <label id="genderfont" for="gender">Female</label>
                                </div>
                                <br>
                                <label for="missionstatement">Mission Statement</label>
                                <textarea id="missionstatement" name="missionstatement" rows="10" placeholder="Enter the candidate mission statement here..." required>' . $missionstatement . '</textarea>
                            </div>
                        </div>
                        <div id="line"></div>
                        <div class="updatecandidates-footer">
                            <input type="submit" value="Update Data">
                            <h4 onclick="editcandidates_close();">Close</h4>
                        </div>
                    </form>
                </div>';
                    } else {
                        echo "<tr><td colspan='8' style='padding: 10%'>No Records Found</td></tr>";
                    }
                }
                ?>
            </div>
            <div class="DelElectionBatch">
                <div class="DelElectionBatch-blackbackground" onclick=""></div>
                <div class="DelElectionBatch-background">
                    <form action="./back_end/deletebatch.php" id="myForm9" method="post" enctype="multipart/form-data"
                        onsubmit="deleting_electionbatch();">
                        <h2>Enter Password to Delete
                            <?php if (isset($_SESSION['Batch'])) {
                                echo $_SESSION['Batch'];
                            } else {
                                echo "LSCBatch$_SESSION[defaultBatch]";
                            } ?>
                        </h2>
                        <div class="line"></div>
                        <div class="DelElectionBatch-main">
                            <div class="DelElectionBatch-left">
                                <br>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    placeholder="Enter Your Password Here..." autocomplete="off" required>
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="DelElectionBatch-footer">
                            <input type="submit" value="Delete Now">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="DownloadDatabase">
                <div class="DownloadDatabase-blackbackground" onclick=""></div>
                <div class="DownloadDatabase-background">
                    <form action="./back_end/backup_download.php" id="myForm7" method="post"
                        enctype="multipart/form-data" onsubmit="DownloadDatabaseBTN();">
                        <h2>Enter Password to Download the Database</h2>
                        <div class="line"></div>
                        <div class="DownloadDatabase-main">
                            <div class="DownloadDatabase-left">
                                <br>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    placeholder="Enter Your Password Here..." autocomplete="off" required>
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="DownloadDatabase-footer">
                            <input type="submit" value="Download Now">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div id="result"><!-- WAG MO ITO TTANGGALING IMPORTANTE PARA SA RELOAD AFTER MAG ADD NG EXCEL--></div>
            <div class="SuperNewAdmin">
                <div class="SuperNewAdmin-blackbackground" onclick=""></div>
                <div class="SuperNewAdmin-background">
                    <form action="./back_end/createnew_superadmin.php" id="myForm6" method="post"
                        enctype="multipart/form-data">
                        <h2>Create New Superadmin</h2>
                        <div class="line"></div>
                        <div class="SuperNewAdmin-main">
                            <div class="SuperNewAdmin-left">
                                <label for="superadminusername">Username</label>
                                <input type="text" name="superadminusername" id="superadminusername"
                                    placeholder="Enter The Username Here..." autocomplete="off" required>
                                <br>
                                <label for="superadminpassword">Password</label>
                                <input type="password" name="superadminpassword" id="superadminpassword"
                                    placeholder="Enter The Password Here..." required>
                                <img src="./assets/hide.png" id="hide" onclick="superadminpasswordPasswordshowhide();"
                                    alt="">
                                <img src="./assets/show.png" id="show" onclick="superadminpasswordPasswordshowhide();"
                                    alt="">
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="SuperNewAdmin-footer">
                            <input type="submit" id="SuperNewAdminSubmit" value="Create New Superadmin">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ListofSuperadmins">
                <div class="ListofSuperadmins-blackbackground"></div>
                <div class="ListofSuperadmins-background">
                    <h2>List of Super Administrator</h2>
                    <div class="line"></div>
                    <div class="ListofSuperadmins-main">
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include './back_end/listofsuperadmins.php'; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="line"></div>
                    <div class="ListofSuperadmins-footer">
                        <h4>Close</h4>
                    </div>
                    </form>
                </div>
            </div>
            <div class="NewAdmin">
                <div class="NewAdmin-blackbackground" onclick=""></div>
                <div class="NewAdmin-background">
                    <form action="./back_end/createnew_admin.php" id="myForm5" method="post"
                        enctype="multipart/form-data">
                        <h2>Create New Admin</h2>
                        <div class="line"></div>
                        <div class="NewAdmin-main">
                            <div class="NewAdmin-left">
                                <label for="adminusername">Username</label>
                                <input type="text" name="adminusername" id="adminusername"
                                    placeholder="Enter The Username Here..." autocomplete="off" required>
                                <br>
                                <label for="adminpassword">Password</label>
                                <input type="password" name="adminpassword" id="adminpassword"
                                    placeholder="Enter The Password Here..." required>
                                <img src="./assets/hide.png" id="hide" onclick="adminPasswordshowhide();" alt="">
                                <img src="./assets/show.png" id="show" onclick="adminPasswordshowhide();" alt="">
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="NewAdmin-footer">
                            <input type="submit" id="NewAdminSubmit" value="Create New Admin">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ListofAdmins">
                <div class="ListofAdmins-blackbackground"></div>
                <div class="ListofAdmins-background">
                    <h2>List of Administrator</h2>
                    <div class="line"></div>
                    <div class="ListofAdmins-main">
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include './back_end/listofadmins.php'; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="line"></div>
                    <div class="ListofAdmins-footer">
                        <h4>Close</h4>
                    </div>
                    </form>
                </div>
            </div>
            <div class="SendPasswordToEmails">
                <div class="SendPasswordToEmails-blackbackground" onclick=""></div>
                <div class="SendPasswordToEmails-background">
                    <form action="./back_end/sendpassword_student.php" id="myForm3" method="post"
                        enctype="multipart/form-data" onsubmit="SendingPasswordToStudents();">
                        <h2>Enter Password to Send Passwords on their Bulsu Emails</h2>
                        <div class="line"></div>
                        <div class="SendPasswordToEmails-main">
                            <div class="SendPasswordToEmails-Top">
                                <div class="SendPawordToEmails-Top-Left">
                                    <h3>Specify Voting Time Limit</h3>
                                    <div class="SendPasswordToEmails-Top-Body">
                                        <input type="time" id="appt" name="start" required />
                                        <h3>To</h3>
                                        <input type="time" id="appt" name="stop" required />
                                    </div>
                                    <br>
                                    <h3>Date</h3>
                                    <div class="SendPasswordToEmails-Top-Body1">
                                        <input type="date" name="votingdate" id="votingdate" required>
                                    </div>
                                </div>
                                <div class="SendPawordToEmails-Top-Right">
                                    <label id="NotAll" for="Choose"><input type="radio" id="NotAll" name="Choose"
                                            value="NotAll" required> Does Students Didn't Send</label>
                                    <label id="All" for="Choose"><input type="radio" id="All" name="Choose" value="All"
                                            required> All Students</label>
                                    <label id="Resched" for="Choose"><input type="radio" id="Resched" name="Choose"
                                            value="Resched" required> Reschedule / All Student</label>
                                </div>
                            </div>
                            <div class="SendPasswordToEmails-left">
                                <br>
                                <label for="password">Password</label>
                                <div>
                                    <input type="password" name="password" id="password"
                                        placeholder="Enter Your Password Here..." autocomplete="off" required>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="SendPasswordToEmails-footer">
                            <input type="submit" value="Send Password Now">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="GeneratePassword">
                <div class="GeneratePassword-blackbackground" onclick=""></div>
                <div class="GeneratePassword-background">
                    <form action="./back_end/generate_random_password.php" id="myForm4" method="post"
                        enctype="multipart/form-data" onsubmit="generaterandompassword();">
                        <h2>Enter Password to Re-Generate Students Password</h2>
                        <div class="line"></div>
                        <div class="GeneratePassword-main">
                            <div class="GeneratePassword-left">
                                <br>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    placeholder="Enter Your Password Here..." autocomplete="off" required>
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="GeneratePassword-footer">
                            <input type="submit" value="Randomize The Students Password">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="activateVoters">
                <div class="activateVoters-blackbackground" onclick=""></div>
                <div class="activateVoters-background">
                    <form id="myForm2" method="post" enctype="multipart/form-data"
                        onsubmit="activateordeactivatestudent();">
                        <h2>Enter Password to Activate/Deactivate Students Account</h2>
                        <div class="line"></div>
                        <div class="activateVoters-main">
                            <div class="activateVoters-left">
                                <br>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    placeholder="Enter Your Password Here..." autocomplete="off" required>
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="activateVoters-footer">
                            <input type="submit" value="Activate/Deactivate Students Account Now">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ElectionInformation">
                <?php
                if (isset($_SESSION['Batch'])) {
                    $currentBatch = $_SESSION['Batch'];
                    $sql = "SELECT * FROM lsc_election_list WHERE lscbatch_list = '$currentBatch'";
                } else {
                    $sql = "SELECT * FROM lsc_election_list ORDER BY lscbatch_id DESC";
                }
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Access the individual fields from the database and display them
                    $lscbatch_id = $row["lscbatch_id"];
                    $lscbatch_list = $row["lscbatch_list"];
                    $lscdate = $row["date"];
                    $electiondetails = $row["electiondetails"];

                    echo '
                    <div class="ElectionInformation-blackbackground" onclick="ElectionInformationBack();"></div>
                    <div class="ElectionInformation-background">
                        <form action="" id="myForm" method="post" enctype="multipart/form-data">
                            <h2>Election Information</h2>
                            <div class="line"></div>
                            <div class="ElectionInformation-main">
                                <div class="ElectionInformation-left">
                                    <label for="">Name of Election Event</label>
                                    <input type="text" name="" id="" placeholder="e.g LSCBatch2022-2023" value="' . $lscbatch_list . '" autocomplete="off" disabled>
                                    <br>
                                    <label for="">Date</label>
                                    <input type="date" name="" id="" disabled value="' . $lscdate . '">
                                    <br>
                                    <label for="">Election is all about:</label>
                                    <textarea id="" name="" rows="11" placeholder="Enter the Election information here to know what Election is all about..." disabled>' . $electiondetails . '</textarea>
                                    <br>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="ElectionInformation-footer">
                                <div onclick="DeleteElectionBatch();" id="btnClose">
                                    <h3>Delete This Election Batch</h3>
                                </div>  
                                <h4>Close</h4>
                            </div>
                        </form>
                    </div>
                    ';
                }
                ?>
            </div>
            <div class="NewElection">
                <div class="NewElection-blackbackground"></div>
                <div class="NewElection-background">
                    <form action="./back_end/new_election.php" id="myForm1" method="post" enctype="multipart/form-data">
                        <h2>New Election Event</h2>
                        <div class="line"></div>
                        <div class="NewElection-main">
                            <div class="NewElection-left">
                                <label for="electionname">Name of Election Event</label>
                                <input type="text" name="electionname" id="electionname"
                                    placeholder="e.g LSCBatch2022-2023" value="LSCBatch202_-202_" autocomplete="off"
                                    required>
                                <br>
                                <label for="datecreation">Date</label>
                                <input type="date" name="datecreation" id="datecreation" required>
                                <br>
                                <label for="electiondetails">Election is all about:</label>
                                <textarea id="electiondetails" name="electiondetails" rows="11"
                                    placeholder="Enter the Election information here to know what Election is all about..."
                                    required></textarea>
                                <br>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="NewElection-footer">
                            <input type="submit" value="Create New Election Event Now" onclick="NewElection(event);">
                            <h4>Close</h4>
                        </div>
                    </form>
                </div>
            </div>
            <div class="edit_student">
                <?php
                include_once './back_end/connection.php';

                if (isset($_GET['id'])) {
                    $studentID = $_GET['id'];

                    if (isset($_SESSION['Batch'])) {
                        $currentBatch = $_SESSION['currentBatch'];
                        $sql = "SELECT * FROM `students_batch$currentBatch` WHERE student_number='$studentID'";
                    } else {
                        $defaultBatch = $_SESSION['defaultBatch'];
                        $sql = "SELECT * FROM `students_batch$defaultBatch` WHERE student_number='$studentID'";
                    }
                    $result = $conn->query($sql);

                    function getMiddleNameInitials2($Mname)
                    {
                        $words = explode(' ', $Mname);
                        $initials = '';
                        foreach ($words as $word) {
                            $initials .= strtoupper(substr($word, 0, 1)) . '.';
                        }
                        return rtrim($initials, '.'); // Remove trailing period if it exists
                    }

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        // Access the individual fields from the database and display them
                        $id = $row["student_number"];
                        $student_id = $row["student_id"];
                        $Fname = str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $row["Fname"]);
                        $Lname = str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $row["Lname"]);
                        $Mname = str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $row["Mname"]);
                        $MiddleInitialOnly = strtoupper(getMiddleNameInitials2(str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $Mname)));
                        $Suffix = str_replace(['ñ', 'Ñ'], ['&ntilde;', '&Ntilde;'], $row["suffix"]);
                        $Suffix = strtoupper($Suffix);


                        if ($Suffix != "") {
                            $fullname_student = $Lname . ',' . $Fname . ' ' . $Suffix . ' ' . $MiddleInitialOnly . '.';
                        } else {
                            $fullname_student = $Lname . ',' . $Fname . ' ' . $MiddleInitialOnly . '.';
                        }

                        $cysg = $row["cysg"];
                        $email_address = $row["email_address"];

                        echo '
                        <div class="editstudent-blackbackground" onclick="editstudent_close();"></div>
                        <div class="editstudent-background">
                            <form action="./back_end/edit_student.php?id=' . $id . '" id="myForm0" method="post" enctype="multipart/form-data">
                                <h2>Edit Student</h2>
                                <div class="line"></div>
                                <div class="editstudent-main">
                                    <div class="editstudent-left">
                                        <label for="student_id">Student ID</label>
                                        <input type="number" name="student_id" value="' . $student_id . '" id="student_id" placeholder="Enter your Student ID here..." autocomplete="off" required>
                                        <br>
                                        <label for="fullname">FullName Preview</label>
                                        <input type="text" name="fullname" value="' . $fullname_student . '" id="fullname" readonly>
                                        <br>
                                        <label for="cysg">CYSG</label>
                                        <input type="text" name="cysg" value="' . $cysg . '" id="cysg" readonly>
                                        <br>
                                        <label for="emailaddress">Current Email Address</label>
                                        <input type="text" name="emailaddress" value="' . $email_address . '" id="emailaddress" readonly>
                                        <br>
                                    </div>
                                    <div id="line-portrait"></div>
                                    <div class="editstudent-right">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" name="firstname" value="' . $Fname . '" id="firstnamestudent" oninput="updateEmailAddress();" placeholder="Enter your Firstname here..." autocomplete="off" required>
                                        <br>
                                        <label for="middlename">Middlename</label>
                                        <input type="text" name="middlename" value="' . $Mname . '" id="middlenamestudent" oninput="updateEmailAddress();" placeholder="Enter your Middlename here..." autocomplete="off" required>
                                        <br>
                                        <label for="lastname">Lastname</label>
                                        <input type="text" name="lastname" value="' . $Lname . '" id="lastnamestudent" oninput="updateEmailAddress();" placeholder="Enter your Lastname here..." autocomplete="off" required>
                                        <br>
                                        <label for="Suffix">Suffix (eg. jr, ii, iii, iv)</label>
                                        <input type="text" name="Suffix" value="' . $Suffix . '" id="Suffixstudent" oninput="updateEmailAddress();" placeholder="Enter your Suffix here..." autocomplete="off" required>
                                        <br>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="editstudent-footer">
                                    <div>
                                        <input type="button" name="submitButton" value="Update Data" onclick="editstudentdetails();">
                                        <input type="button" id="submitbtn2" name="submitButton" value="Regenerate and Resend Password" onclick="regeneratepasswordandsend();">                                    
                                    </div>                                    
                                    <h4 onclick="editstudent_close();">Close</h4>
                                </div>
                            </form>
                        </div>
                        <script>
                            var studentID = ' . json_encode($studentID) . ';
                        </script>
                        ';

                        /*echo '
                        <div class="editstudent-blackbackground" onclick="editstudent_close();"></div>
                        <div class="editstudent-background">
                            <form action="./back_end/edit_student.php?id=' . $id . '" id="myForm0" method="post" enctype="multipart/form-data">
                                <h2>Edit Student</h2>
                                <div class="line"></div>
                                <div class="editstudent-main">
                                    <div class="editstudent-left">
                                        <label for="student_id">Student ID</label>
                                        <input type="number" name="student_id" value="' . $student_id . '" id="student_id" placeholder="Enter your Student ID here..." autocomplete="off" required>
                                        <br>
                                        <label for="fullname">FullName Preview</label>
                                        <input type="text" name="fullname" value="' . $fullname_student . '" id="fullname" readonly>
                                        <br>
                                        <label for="cysg">CYSG</label>
                                        <input type="text" name="cysg" value="' . $cysg . '" id="cysg" readonly>
                                        <br>
                                        <label for="emailaddress">Current Email Address</label>
                                        <input type="text" name="emailaddress" value="' . $email_address . '" id="emailaddress" readonly>
                                        <br>
                                    </div>
                                    <div id="line-portrait"></div>
                                    <div class="editstudent-right">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" name="firstname" value="' . $Fname . '" id="firstnamestudent" oninput="updateEmailAddress();" placeholder="Enter your Firstname here..." autocomplete="off" required>
                                        <br>
                                        <label for="middlename">Middlename</label>
                                        <input type="text" name="middlename" value="' . $Mname . '" id="middlenamestudent" oninput="updateEmailAddress();" placeholder="Enter your Middlename here..." autocomplete="off" required>
                                        <br>
                                        <label for="lastname">Lastname</label>
                                        <input type="text" name="lastname" value="' . $Lname . '" id="lastnamestudent" oninput="updateEmailAddress();" placeholder="Enter your Lastname here..." autocomplete="off" required>
                                        <br>
                                        <label for="Suffix">Suffix (eg. jr, ii, iii, iv)</label>
                                        <input type="text" name="Suffix" value="' . $Suffix . '" id="Suffixstudent" oninput="updateEmailAddress();" placeholder="Enter your Suffix here..." autocomplete="off" required>
                                        <br>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="editstudent-footer">
                                    <div>
                                        <input type="submit" name="submitButton1" value="Update Data" onclick="editstudentdetails();">
                                        <input type="submit" id="submitbtn2" name="submitButton2" value="Regenerate and Resend Password" onclick="regeneratepasswordandsend();">
                                    </div>
                                    <h4 onclick="editstudent_close();">Close</h4>
                                </div>
                            </form>
                        </div>
                        ';*/
                    }
                }
                ?>
            </div>
        </section>
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
            <h1 class="txt4">This website is not accessible on your current device. Please ensure that your device's
                display resolution meets the minimum requirement of 1280 pixels width or higher.</h1>
        </div>
    </div>
    <script src="./superadmin.js"></script>
</body>

</html>