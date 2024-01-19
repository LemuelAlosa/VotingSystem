<?php
include './back_end/checker.php';
include_once './back_end/connection.php';

$sql = "SELECT * FROM `lsc_election_list` WHERE status = 'activated'";
$resultDB = $conn->query($sql);

// Check if a row was returned from 'admins' table
if ($resultDB->num_rows === 1) {
    $rowDB = $resultDB->fetch_assoc();
    $studentstoredbatch = $rowDB["students_batch"];
    $candidatestoredbatch = $rowDB["candidate_batch"];
    $candidatestoredposition = $rowDB["candidate_position"];
    $storedbatch = $rowDB["lscbatch_list"];

    $_SESSION['S_Batch'] = $studentstoredbatch;
    $_SESSION['C_Batch'] = $candidatestoredbatch;
    $_SESSION['C_Position'] = $candidatestoredposition;
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
    <link rel="stylesheet" href="voting.css">
    <title>Vote Now!!!</title>
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
            <h2>BulSU - Hagonoy Election<br><?php echo $storedbatch; ?></h2>
        </div>
        <form action="./finalize.php" id="VotingForm" method="post" enctype="multipart/form-data">
                <?php
                    $sql_search = "SELECT * FROM `$candidatestoredposition`";
                    $result_outer = $conn->query($sql_search);
                    
                    $section = 1;
                    $clearselec = 0;
                    $numchoice = 0;

                    if ($result_outer->num_rows > 0) {
                        while ($rowstored = $result_outer->fetch_assoc()) {
                            $position = strtoupper($rowstored["position"]);
                            $section++;
                            $numchoice++;
                            
                            echo '  <div class="section'.$section.'">
                                        <div class="section'.$section.'top">
                                            <h2 id="nav'.$section.'">'.$position.'</h2>
                                            <img src="./assets/lessthan.png" alt="">
                                        </div>
                                        <div class="section'.$section.'-'.$section.'">';

                            $sql_search1 = "SELECT * FROM `$candidatestoredbatch` WHERE Position = '$position'";
                            $result = $conn->query($sql_search1);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row["id"];
                                    $fullname_candidate = '';
                                    $Fname = $row["Firstname_candidate"];
                                    $Lname = $row["Lastname_candidate"];
                                    $Mname = substr($row["Middlename_candidate"], 0, 1);
                                    $Suffix = strtoupper($row["suffix"]);
                                    if($Mname != ""){
                                        if($Suffix != ""){
                                            $fullname_candidate = $Lname .', '. $Fname .' '.$Suffix.' '. $Mname .'.';
                                        }else{
                                            $fullname_candidate = $Lname .', '. $Fname .' '. $Mname .'.';
                                        }
                                    }else{
                                        $fullname_candidate = $Lname .', '. $Fname;
                                    }
                                    $imagecandidatefilename = $row["Image"];
                                    $MissionStatement = $row["Mission"];
        
                                    echo '
                                        <div class="candidate">
                                            <div class="candidate-left">
                                                <img src="../admins/admin_section/candidates_images/' . $imagecandidatefilename . '" id="candidate-img" alt="">
                                                <h2 id="candidate-name">' . $fullname_candidate . '</h2>
                                            </div>
                                            <div class="candidate-right">
                                                <a id="candidate-mission" href="./index.php?id=' . $id . '">
                                                    <img src="./assets/missionstatement.png" alt="">
                                                    <h3>Mission Statement</h3>
                                                </a>
                                                <input type="radio" name="choices'.$numchoice.'" value="' . $id . '">
                                            </div>
                                        </div>
                                        ';
                                }    
                            } else {
                                echo "No Candidate Selected";
                            }

                            $clearselec++;
                            if ($result->num_rows > 0) {
                                echo '<h3 onclick="clearSelection'.$clearselec.'();" id="ClearSelec">Clear Selection</h3>';
                            }else{
                                echo '<h3 onclick="clearSelection'.$clearselec.'();" id="ClearSelec"></h3>';
                            }

                            echo '</div>
                            </div>';
                        }
                    }
                ?>
                <div class="sectionlast">
                    <button type="submit">Next</button>
                </div>
        </form>
    </div>


    <?php 
    if (isset($_GET['id'])) {
        $candidateId = $_GET['id'];

        $sql = "SELECT * FROM `$candidatestoredbatch` WHERE id='$candidateId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
                $position = $row["Position"];
                $fullname_Candidate = '';
                $firstname = $row["Firstname_candidate"];
                $lastname = $row["Lastname_candidate"];
                $middlename = substr($row["Middlename_candidate"], 0, 1);
                $Suffix = strtoupper($row["suffix"]);
                if($middlename != ""){
                    if($Suffix != ""){
                        $fullname_Candidate = $lastname .', '. $firstname .' '.$Suffix.' '. $middlename .'.';
                    }else{
                        $fullname_Candidate = $lastname .', '. $firstname .' '. $middlename .'.';
                    }
                }else{
                    $fullname_Candidate = $lastname .', '. $firstname;
                }
                $yearlevel = $row["Yearlevel"];
                $course = $row["Course"];
                $gender = $row["Gender"];
                $missionstatement = $row["Mission"];
                $imagecandidatefilename = $row["Image"];

                echo '
                <div class="candidateprofile-blackbackground"></div>
                <div class="candidateprofile-background">
                        <h2>Candidate Profile</h2>
                        <div class="line"></div>
                        <div class="candidateprofile-main">
                            <div class="candidateprofile-left">
                                <img src="../admins/admin_section/candidates_images/'.$imagecandidatefilename.'" alt="">
                                <h3>'.$position.'</h3>
                            </div>
                            <div class="candidateprofile-right">
                                <h3 id="name">'. $fullname_Candidate .'</h3>
                                <br>
                                <div class="mission">
                                    <h4>Mission Statement</h4>
                                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$missionstatement.'</h5>
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="candidateprofile-footer">
                            <h4>Close</h4>
                        </div>
                </div>
                ';
        }
    }
    ?>




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





    <script src="voting.js"></script>
</body>

</html>