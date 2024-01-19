<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

function getCurrentLSCBatch($conn) {

    if (isset($_SESSION['Batch'])){
        if($_SESSION['Batch'] == "LSCBatch2021-2022"){
            echo "CannotDelete";
            exit();
        }else{
            echo $_SESSION['Batch'];
        }
    }else{
        if($_SESSION['defaultBatch'] == "2021-2022"){
            echo "CannotDelete";
            exit();
        }else{
            echo "LSCBatch$_SESSION[defaultBatch]";
        }
    }
}

getCurrentLSCBatch($conn);