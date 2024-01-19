<?php
    //include 'config.php';
    include 'checker.php';
    include_once 'connection.php';
    
    $position = $_GET['position'];
    $partylist = $_GET['partylist'];
    $filterSql = "";
    
    if ($position !== 'All' && $partylist !== 'All') {
        $filterSql = "WHERE Position = '$position' AND Partylist = '$partylist'";
    } elseif ($position !== 'All') {
        $filterSql = "WHERE Position = '$position'";
    } elseif ($partylist !== 'All') {
        $filterSql = "WHERE Partylist = '$partylist'";
    }

    function getMiddleNameInitials($Mname) {
        $words = explode(' ', $Mname);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1)) . '.';
        }
        return rtrim($initials, '.'); // Remove trailing period if it exists
    }
    
    $sql = "SELECT * FROM `lsc_election_list` WHERE status = 'activated'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $rowactivated = $result->fetch_assoc();
        $candidatebatch = $rowactivated["candidate_batch"];
    
        $sqlcandidate = "SELECT * FROM `$candidatebatch` $filterSql ORDER BY id DESC";
        $resultcandidate = $conn->query($sqlcandidate);
    
        if ($resultcandidate->num_rows > 0) {
            while ($row = $resultcandidate->fetch_assoc()) {
                // Access the individual fields from the database and display them
                $id = $row["id"];
                $fullname_student = '';
                $position = $row["Position"];
                $partylist = $row["Partylist"];
                $firstname = $row["Firstname_candidate"];
                $middlename = strtoupper(getMiddleNameInitials($row["Middlename_candidate"]));
                $lastname = $row["Lastname_candidate"];
                $Suffix = strtoupper($row["suffix"]);
                if($middlename != ""){
                    if($Suffix != ""){
                        $fullname_student = $lastname .','. $firstname .' '.$Suffix.' '. $middlename .'.';
                    }else{
                        $fullname_student = $lastname .','. $firstname .' '. $middlename .'.';
                    }
                }else{
                    $fullname_student = $lastname .','. $firstname;
                }
                $yearlevel = $row["Yearlevel"];
                $course = $row["Course"];
                $gender = $row["Gender"];
                $missionstatement = $row["Mission"];
                $imagecandidatefilename = $row["Image"];

                echo "<tr>
                    <td>" . $position . "</td>
                    <td>" . $partylist . "</td>
                    <td>" . $fullname_student . "</td>
                    <td>" . $yearlevel . " yr</td>
                    <td>" . $course . "</td>
                    <td>" . $gender . "</td>
                    <td><img src='./candidates_images/" . $imagecandidatefilename . "' alt=''></td>
                    <td class='missionstate'>" . $missionstatement . "</td>
                    <td>
                        <div class='button'>
                            <a id='colorway2' href='./index.php?id=".$id."'>
                                <img src='./assets/more.png' alt=''>
                                <h4>Edit</h4>
                            <a>
                            <a id='colorway1' href='#' data-id='$id' onclick='prepareCandidateRemoval(event);'>
                                <img src='./assets/remove.png' alt=''>
                                <h4>Remove</h4>
                            <a>
                        </div>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='9' style='padding: 10%'>No Records Found</td></tr>";
        }
    }
