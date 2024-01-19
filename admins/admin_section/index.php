<?php
//include './back_end/config.php';
include './back_end/checker.php';
include_once './back_end/connection.php';

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="./images/LSC_Logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="admin.css">
    <title>Admin</title>
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
    <div class="secondheader">
        <div class="left-secondheader">
            <h2>ADMIN</h2>
        </div>
        <div class="right-secondheader">
            <h2>Candidates List</h2>
            <button onclick="Logout();">
                <img src="./assets/logout.png" alt="">
                <h3>Logout</h3>
            </button>
        </div>
    </div>
    <div id="line"></div>
    <div class="main">
        <section>
            <div class="section1">
                <h2>Candidates for
                    <?php echo $_SESSION["current_batch"]; ?>
                </h2>
            </div>
            <div class="section2">
                <div class="section2-left">
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
                    <h2>Position</h2>

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
                    <h2>PartyList</h2>
                </div>
                <div class="section2-right">
                    <div class="div1">
                        <div class="section2-right4" onclick="ListOfPositions();">
                            <img src="./assets/addcandidate.png" alt="">
                            <h3>List of Position</h3>
                        </div>
                        <div class="section2-right5" onclick="ListOfPartylist();">
                            <img src="./assets/addcandidate.png" alt="">
                            <h3>List of PartyList</h3>
                        </div>
                    </div>
                    <div class="div2">
                        <div class="section2-right1" onclick="addcandidate();">
                            <img src="./assets/addcandidate.png" alt="">
                            <h3>Add Candidates</h3>
                        </div>
                        <div class="section2-right2" onclick="addposition();">
                            <img src="./assets/addcandidate.png" alt="">
                            <h3>Add Position</h3>
                        </div>
                        <div class="section2-right3" onclick="addpartylist();">
                            <img src="./assets/addcandidate.png" alt="">
                            <h3>Add PartyList</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section3">
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
                            <th>Mission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="candidateTableBody"></tbody>
                </table>
            </div>
        </section>
    </div>







    <!-- Admin Module Side -->
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
            <form action="./back_end/addnew_partylist.php" id="myForm1" method="post" enctype="multipart/form-data"
                onsubmit="addnowpartylist();">
                <h2>Add New PartyList on
                    <?php echo $_SESSION["current_batch"]; ?>
                </h2>
                <div class="line"></div>
                <div class="addpartylist_candidate-main">
                    <div class="addpartylist_candidate-left">
                        <br>
                        <label for="partylistname">PartyList Team: </label>
                        <input type="text" name="partylistname" id="partylistname" placeholder="Enter The PartyList Team Here..."
                            autocomplete="off" required>
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
            <form action="./back_end/addnew_position.php" id="myForm0" method="post" enctype="multipart/form-data"
                onsubmit="addnowposition();">
                <h2>Add New Position on
                    <?php echo $_SESSION["current_batch"]; ?>
                </h2>
                <div class="line"></div>
                <div class="addposition_candidate-main">
                    <div class="addposition_candidate-left">
                        <br>
                        <label for="position">Position</label>
                        <input type="text" name="position" id="position" placeholder="Enter The New Position Here..."
                            autocomplete="off" required>
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
        <form action="./back_end/back_end.php" id="myForm" method="post" enctype="multipart/form-data">
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
                            <input type="text" name="firstname" id="firstname" placeholder="Enter Firstname here..."
                                autocomplete="off" required>
                        </div>
                        <div class="div1-right">
                            <label for="middlename">Middlename</label>
                            <input type="text" name="middlename" id="middlename" placeholder="Enter Middlename here..."
                                value="" autocomplete="off">
                        </div>
                    </div>
                    <div>
                    </div>
                    <br>
                    <div class="div1">
                        <div class="div1-left">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Enter Lastname here..."
                                autocomplete="off" required>
                        </div>
                        <div class="div1-right">
                            <label for="suffix">Suffix (eg. jr, ii, iii, iv)</label>
                            <input type="text" name="suffix" id="suffix" placeholder="Enter Suffix here..." value=""
                                autocomplete="off">
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
    <div>
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
                    <form action="./back_end/edit_candidate.php?id=' . $id . '" id="myForm" method="post" enctype="multipart/form-data">
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
                                    if($partylist == 'None'){
                                        echo '<option value="None">None</option>';
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                        $partyliststored = $row["partylist"];
                                        $selected = ($partyliststored == $partylist) ? 'selected' : ''; // Check if it's the desired option

                                        echo '<option value="' . $partyliststored . '" ' . $selected . '>' . $partyliststored . '</option>';
                                    }
                                    if($partylist != 'None'){
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
                                    <img src="./candidates_images/' . $imagecandidatefilename . '" alt="">
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
    <script src="admin.js"></script>
</body>

</html>