<?php
$conn = new mysqli("localhost","root","","bulsuhagonoy_localstudentcouncil_electiondatabase");
// $conn = new mysqli("sql110.infinityfree.com","if0_35454243","bjyxMgERz06XJyp","if0_35454243_bulsuhagonoy_localstudentcouncil_electiondatabase");

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>