<?php
include_once './back_end/checker.php';

if (isset($_SESSION['govChoice'])) {
    unset($_SESSION['govChoice']);
}
if (isset($_SESSION['vicegovChoice'])) {
    unset($_SESSION['vicegovChoice']);
}
if (isset($_SESSION['bmtourismChoice'])) {
    unset($_SESSION['bmtourismChoice']);
}
if (isset($_SESSION['bmeducChoice'])) {
    unset($_SESSION['bmeducChoice']);
}
if (isset($_SESSION['bmitChoice'])) {
    unset($_SESSION['bmitChoice']);
}
if (isset($_SESSION['bmhmandbitChoice'])) {
    unset($_SESSION['bmhmandbitChoice']);
}

header("Location: ../index.php");
exit();
?>