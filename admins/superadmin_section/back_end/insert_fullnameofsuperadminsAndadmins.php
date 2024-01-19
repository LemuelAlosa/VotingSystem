<?php
include_once './checker.php';
include_once './connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['superadmin1'])) {
        $_SESSION['superadmin1'] = $_POST['superadmin1'];
    } else {
        $_SESSION['superadmin1'] = '';
    }
    if (isset($_POST['superadmin2'])) {
        $_SESSION['superadmin2'] = $_POST['superadmin2'];
    } else {
        $_SESSION['superadmin2'] = '';
    }
    if (isset($_POST['superadmin3'])) {
        $_SESSION['superadmin3'] = $_POST['superadmin3'];
    } else {
        $_SESSION['superadmin3'] = '';
    }
    if (isset($_POST['superadmin4'])) {
        $_SESSION['superadmin4'] = $_POST['superadmin4'];
    } else {
        $_SESSION['superadmin4'] = '';
    }
    if (isset($_POST['superadmin5'])) {
        $_SESSION['superadmin5'] = $_POST['superadmin5'];
    } else {
        $_SESSION['superadmin5'] = '';
    }
    if (isset($_POST['superadmin6'])) {
        $_SESSION['superadmin6'] = $_POST['superadmin6'];
    } else {
        $_SESSION['superadmin6'] = '';
    }
    if (isset($_POST['superadmin7'])) {
        $_SESSION['superadmin7'] = $_POST['superadmin7'];
    } else {
        $_SESSION['superadmin7'] = '';
    }
    if (isset($_POST['superadmin8'])) {
        $_SESSION['superadmin8'] = $_POST['superadmin8'];
    } else {
        $_SESSION['superadmin8'] = '';
    }
    if (isset($_POST['superadmin9'])) {
        $_SESSION['superadmin9'] = $_POST['superadmin9'];
    } else {
        $_SESSION['superadmin9'] = '';
    }
    if (isset($_POST['superadmin10'])) {
        $_SESSION['superadmin10'] = $_POST['superadmin10'];
    } else {
        $_SESSION['superadmin10'] = '';
    }

    if (isset($_POST['admin1'])) {
        $_SESSION['admin1'] = $_POST['admin1'];
    } else {
        $_SESSION['admin1'] = '';
    }
    if (isset($_POST['admin2'])) {
        $_SESSION['admin2'] = $_POST['admin2'];
    } else {
        $_SESSION['admin2'] = '';
    }
    if (isset($_POST['admin3'])) {
        $_SESSION['admin3'] = $_POST['admin3'];
    } else {
        $_SESSION['admin3'] = '';
    }
    if (isset($_POST['admin4'])) {
        $_SESSION['admin4'] = $_POST['admin4'];
    } else {
        $_SESSION['admin4'] = '';
    }
    if (isset($_POST['admin5'])) {
        $_SESSION['admin5'] = $_POST['admin5'];
    } else {
        $_SESSION['admin5'] = '';
    }
    if (isset($_POST['admin6'])) {
        $_SESSION['admin6'] = $_POST['admin6'];
    } else {
        $_SESSION['admin6'] = '';
    }
    if (isset($_POST['admin7'])) {
        $_SESSION['admin7'] = $_POST['admin7'];
    } else {
        $_SESSION['admin7'] = '';
    }
    if (isset($_POST['admin8'])) {
        $_SESSION['admin8'] = $_POST['admin8'];
    } else {
        $_SESSION['admin8'] = '';
    }
    if (isset($_POST['admin9'])) {
        $_SESSION['admin9'] = $_POST['admin9'];
    } else {
        $_SESSION['admin9'] = '';
    }
    if (isset($_POST['admin10'])) {
        $_SESSION['admin10'] = $_POST['admin10'];
    } else {
        $_SESSION['admin10'] = '';
    }


    echo '
        <script>
            window.onload = function() {
                generatePDF();
            };

            function generatePDF() {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "./generateresult_pdf.php", true);
                xhr.responseType = "blob";

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var blob = new Blob([xhr.response], { type: "application/pdf" });
                        var link = document.createElement("a");
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "VoteTally_Report.pdf";
                        link.click();
                        
                        window.location.href = "../index.php";

                    }
                };
                xhr.send();
            }
        </script>
        ';

    }