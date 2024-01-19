<?php
session_start();

if (!isset($_SESSION['Logged_in'])) {
    session_unset();
    session_destroy();
    echo "<script>window.location.href = '../index.php';</script>";
} else {
    if (isset($_SESSION['Last_Activity'])) {
        $currentTime = time();
        $lastActivityTime = $_SESSION['Last_Activity'];
        $timeDifference = $currentTime - $lastActivityTime;

        if ($timeDifference > 1800) { // 1800 seconds = 30 minutes
            session_unset();
            session_destroy();
            echo "<script>window.location.href = '../index.php';</script>";
        } else {
            $_SESSION['Last_Activity'] = time();
        }
    } else {
        $_SESSION['Last_Activity'] = time();
    }
}
?>
