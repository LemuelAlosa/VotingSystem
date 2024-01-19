<?php
//include 'config.php';
include 'checker.php';
include_once './connection.php';

function getCurrentLSCBatch($conn) {
    
    if (isset($_SESSION['Batch'])){
        echo $_SESSION['Batch'];
    }else{
        echo "LSCBatch$_SESSION[defaultBatch]";
    }
}

getCurrentLSCBatch($conn);